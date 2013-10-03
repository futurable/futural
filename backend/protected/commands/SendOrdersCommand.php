<?php
class SendOrdersCommand extends CConsoleCommand
{
    public function run($args)
    {   
        echo( date('Y-m-d H:i:s').": SendOrders run started.\n" );
                 
            if($IHSuccess AND $ILSuccess AND $POHSuccess AND $POLSuccess AND $orderSuccess){
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