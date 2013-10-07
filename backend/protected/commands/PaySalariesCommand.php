<?php
class PaySalariesCommand extends CConsoleCommand
{
    public function run($args)
    {   
        echo( date('Y-m-d H:i:s').": PaySalaries run started.\n" );

        # 1. Get all companies
        $companies = Company::model()->findAll();
        
        echo( "Found ".count($companies)." companies\n");
        
        # 2. Run through each company
        foreach($companies as $company){
            echo( "Using company {$company->name}\n");
            
            # 3. Check if there are salaries to be paid
            $criteria = new CDbCriteria();
            $criteria->addCondition("id={$company->id}");
            $criteria->order = 'create_date DESC';
            $lastSalary = Salary::model()->find( $criteria );
            
            if(empty($lastSalary) OR $lastSalary->week < date('W')){
                echo( "Salary payment pending\n" );
                // Do the payment
                $bankTransaction = new BankTransaction;
            }
            else{
                echo( "No salary payment pending\n" );
                // Do nothing
                continue;
            }
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
        
        echo( date('Y-m-d H:i:s').": PaySalaries run ended.\n\n" );
    }
}