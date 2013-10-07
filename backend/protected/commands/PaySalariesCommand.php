<?php
class PaySalariesCommand extends CConsoleCommand
{
    public function run($args)
    {   
        echo( date('Y-m-d H:i:s').": PaySalaries run started.\n" );

        # 1. Get all companies
        $companies = Company::model()->findAll();
        
        echo( "Found ".count($companies)." companies\n");
        
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
        
        echo( date('Y-m-d H:i:s').": PaySalaries run ended.\n\n" );
    }
}