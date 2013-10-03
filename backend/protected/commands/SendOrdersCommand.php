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