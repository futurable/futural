<?php
class SendOrdersCommand extends CConsoleCommand
{
    public function run($args)
    {   
        echo( date('Y-m-d H:i:s').": SendOrders run started.\n" );
        
        # 1. See if there are orders to be sent
        $criteria = new CDbCriteria();
        $criteria->addCondition('sent IS NULL');
        $orders = Order::model()->findAll( $criteria );
        
        if(empty($orders)){
            die( "No sendable orders. Exiting.\n" );
        }
        else{
            echo( count($orders)." unsent orders found\n" );
        }
        
        require_once('../tcpdf/tcpdf.php');
        
        # 2. Run through each order
        foreach($orders as $order){
            // Get the supplier
            $company = Company::model()->findByPk($order->company_id);
            echo( "Using company {$company->name}\n" );
            
            // Get the OpenERP order
            $OEOrder = PurchaseOrder::model()->findByPk($order->openerp_purchase_order_id);
            
            /**
             *  Create the PDF
             */
            
            // create new PDF document
            $invoicePDF = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            
            $invoiceTitle = $company->name.' '.$OEOrder->name;
            $logo = null; // @TODO: get logo
            $contact = ResPartner::model()->findByPk($OEOrder->createU->partner_id);
            $contactName = $contact->name;
            
            // set document information
            $invoicePDF->SetCreator($contactName);
            $invoicePDF->SetAuthor($contactName);
            $invoicePDF->SetTitle('Purchase order');
            $invoicePDF->SetSubject($invoiceTitle);

            // set default header data
            $invoicePDF->SetHeaderData( $logo, 20, $company->name , date('d.m.Y'), array(0,0,0), array(0,0,0));
            $invoicePDF->setFooterData(array(0,64,0), array(0,64,128));
            
            // set header and footer fonts
            $invoicePDF->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $invoicePDF->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $invoicePDF->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $invoicePDF->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $invoicePDF->SetHeaderMargin(PDF_MARGIN_HEADER);
            $invoicePDF->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $invoicePDF->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $invoicePDF->setImageScale(PDF_IMAGE_SCALE_RATIO);
            
            // set default font subsetting mode
            $invoicePDF->setFontSubsetting(true);

            // Set font
            // dejavusans is a UTF-8 Unicode font, if you only need to
            // print standard ASCII chars, you can use core fonts like
            // helvetica or times to reduce file size.
            $invoicePDF->SetFont('dejavusans', '', 10, '', true);

            // Add a page
            // This method has several options, check the source code documentation for more information.
            $invoicePDF->AddPage();
            
            $customer = $OEOrder->company->partner;
            
            // The message content
            $html = "<p>";
            $html .= "{$customer->name}"; // Set customer info
            $html .= "<br/>{$customer->street}"; // Set customer info
            $html .= "<br/>{$customer->zip} {$customer->city}"; // Set customer info
            $html .= "<br/>{$customer->country->name}"; // Set customer info
            $html .= "<p>";
            
            $html .= "<p>";
            $html .= "{$customer->email}";
            $html .= "<p>";
            
            $html .= "<p> </p>";
            $html .= "<p> </p>";
            
            $html .= "<p><strong>";
            $html .= Yii::t("Order", "PurhcaseOrder")." $OEOrder->name ";
            $html .= "</strong></p>";
            
            $html .= "<table>";
                $html .= "<tr>";
                    $html .= "<td><strong>".Yii::t('Order', 'Description')."</strong></td>";
                    $html .= "<td><strong>".Yii::t('Order', 'Quantity')."</strong></td>";
                $html .= "</tr>";
           
            $orderLines = PurchaseOrderLine::model()->findall(array('condition'=>"order_id={$OEOrder->id}"));
            foreach($orderLines AS $orderLine){
                $html .= "<tr>";
                    $html .= "<td>{$orderLine->name}</td>";
                    $html .= "<td>{$orderLine->product_qty}</td>";
                $html .= "</tr>";
            }
            $html .= "</table>";
            
            // Print text using writeHTMLCell()
            $invoicePDF->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            
            $filename = $company->name."_".$OEOrder->name.'.pdf';
            $invoicePDF->Output($filename, 'F');
        }
            
        $transaction = Yii::app()->db->beginTransaction();
        $success = false;
        if($success){
            echo( "Transaction successful\n" );
            $transaction->commit();
        }
        else{
            echo( "Transaction failed\n" );
            $transaction->rollback();
        }
        
        echo( date('Y-m-d H:i:s').": SendOrders run ended.\n\n" );
    }
}