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