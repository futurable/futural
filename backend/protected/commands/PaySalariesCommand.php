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
            
            if(!empty($lastSalary) AND $lastSalary->week == date('W')){
                echo( "No salary payment pending\n" );
                // Do nothing
                continue;
            }
            
            echo( "Salary payment pending\n" );
            // Get the bank user
            $bankUser = BankUser::model()->FindByAttributes(array('username'=>$company->tag));
            if(empty($bankUser)){
                echo( "Company has no bank user. Skipping\n" );
                continue;
            }
            // Get a bank account
            $bankAccount = BankAccount::model()->FindByAttributes(array('bank_user_id'=>$bankUser->id, 'bank_account_type_id'=>1, 'status'=>'enabled'));
            if(empty($bankAccount)){
                echo( "Company has no bank account. Skipping\n" );
                continue;
            }
            // Get the latest cost-benefit calculation
            $criteria = new CDbCriteria();
            $criteria->addCondition("id={$company->id}");
            $criteria->order = 'create_date DESC';
            $CBC = CostbenefitCalculation::model()->find( $criteria );
            
            // Do the payment
            $bankTransaction = new BankAccountTransaction;
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