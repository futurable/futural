<?php
class ExecuteOrdersCommand extends CConsoleCommand
{
    public function run($args)
    {   
        echo( date('Y-m-d H:i:s').": ExecuteOrders run started.\n" );
        
        # 1. See if there are orders to be made
        $criteria = new CDbCriteria();
        $criteria->addCondition('executed IS NULL');
        $orders = Order::model()->findAll( $criteria );
        if(empty($orders)){
            die( "No executable orders. Exiting.\n" );
        }
        else{
            echo( count($orders)." due orders found\n" );
        }
        
        # 2. Get all customers
        $businessCenterDb = Yii::app()->params['businessCenterDb'];
        
        // Change OpenERP-database
        Yii::app()->dbopenerp->setActive(false);
        Yii::app()->dbopenerp->connectionString = "pgsql:host=erp.futurality.fi;dbname={$businessCenterDb}";
        Yii::app()->dbopenerp->setActive(true);
        
        $customers = ResCompany::model()->findAll();
        
        echo( count($customers)." customers found\n" );
        
        // Get all products in their categories
        $products = GetProductsArray::run(true); 
        echo( count($products)." product categories found\n" );

        # 3. Run through each order
        foreach($orders as $order){
            // Get the supplier
            $supplier = Company::model()->findByPk($order->company_id);
            echo( "Creating order for {$supplier->name}\n" );
            
            // Get the customer
            $customer = $customers[ rand( 0, count($customers)-1 ) ];
            echo( "Using customer {$customer->name}\n" );
            
            // Get the partner
            $criteria = new CDbCriteria( array('condition'=>"comment LIKE '{$supplier->tag}%'") );
            $resPartner = ResPartner::model()->find( $criteria );
            $resPartnerComment = explode(":", $resPartner->comment);
            $supplierCategory = intval($resPartnerComment[1]);
            
            // Get products
            if($order->orderSetup->type=='product'){
                // Order supplier-spesific products
                echo( "Ordering supplier-spesific products\n" );
                $purchaseProducts = ProductProduct::model()
                    ->with(array(
                        'productTmpl.productSupplierinfos'=>array('alias'=>'psi')
                    ))->findAll(array('condition'=>"psi.name={$resPartner->id}"));
            }
            elseif($order->orderSetup->type=='group'){
                // Order products from product category
                echo( "Ordering category products\n" );
                
                if(empty($supplierCategory)){
                    echo( "Customer has no category. Skipping the order\n");
                    continue;
                }
                else{
                    $purchaseProducts = $products[ $supplierCategory ];
                }
                
            }
            elseif($order->orderSetup->type=='random'){
                echo( "Ordering random products\n");
                // Order any products
                // Get a random category
                $purchaseProducts = $products[array_rand( $products )];
            }
            
            $validProductsAmount = count($purchaseProducts);
            echo( "Ordering {$order->rows} rows worth of {$order->value} from {$validProductsAmount} products\n");
            
            $orderRows = $validProductsAmount <= $order->rows ? $validProductsAmount : $order->rows;
            // Divide the value between products
            $portions = GetRandomPercentagePortions::run($orderRows);
            
            // Decide the last invoice made
            $criteria = new CDbCriteria();
            $criteria->order = 'id DESC';
            $lastInvoice = AccountInvoice::model()->find($criteria);
            
            $padLength = strlen($lastInvoice->origin)-2;
            $invoiceOrigin = substr($lastInvoice->origin, 0, 2).( str_pad( intval(substr($lastInvoice->origin, 2))+1, $padLength, '0', STR_PAD_LEFT ) );
            
            // Make the invoice header
            $taxAmount = intval($order->value)*0.24; // @TODO: get the percentage from somewhere
            $header = new AccountInvoice();
            $header->check_total = $order->value;
            $header->amount_tax = $taxAmount;
            $header->amount_untaxed = $order->value;
            $header->amount_total = $order->value + $taxAmount;
            $header->partner_id = $resPartner->id;
            $header->company_id = $customer->id; 
            $header->origin = $invoiceOrigin;
            $header->reference = $invoiceOrigin;
            $header->name = $invoiceOrigin;
            
            $transaction = Yii::app()->db->beginTransaction();
            $headerSuccess = $header->save();
            
            $linesSuccess = false;
            // Get the products
            foreach($portions as $portion){
                // Get a product
                $product = $purchaseProducts[ array_rand($purchaseProducts) ];
                
                $break = 10;
                while($product->productTmpl->standard_price == 0){
                    $product = $purchaseProducts[ array_rand($purchaseProducts) ];
                    if($break > 10){
                        echo( "No products with price. Breaking\n");
                        break 2;
                    }
                    $break++;
                }
                echo( "Using product {$product->productTmpl->name}\n" );
                
                $amount = ceil($order->value / $product->productTmpl->standard_price);
                echo( "Ordering {$amount}(s) of '{$product->productTmpl->name}'\n");
                // Make an invoice row
            }
            
            if($headerSuccess AND $linesSuccess){
                echo( "Transactions successful\n" );
                $transaction->commit();
            }
            else{
                echo( "Transactions failed\n" );
                $transaction->rollback();
            }
        }
        echo( date('Y-m-d H:i:s').": ExecuteOrders run ended.\n" );
    }
}