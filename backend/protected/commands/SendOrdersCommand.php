<?php
class SendOrdersCommand extends CConsoleCommand
{
    public function run($args)
    {   
        echo( date('Y-m-d H:i:s').": SendOrders run started.\n" );
        
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