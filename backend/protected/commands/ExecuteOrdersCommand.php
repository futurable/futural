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
        
        # 3. Run through each order
        foreach($orders as $order){
            // Get the supplier
            $supplier = Company::model()->findByPk($order->company_id);
            echo( "Creating order for {$supplier->name}\n" );
            
            // Get the customer
            $customer = $customers[ rand( 0, count($customers)-1 ) ];
            echo( "Using customer {$customer->name}\n" );
        }
        echo( date('Y-m-d H:i:s').": ExecuteOrders run ended.\n" );
    }
}