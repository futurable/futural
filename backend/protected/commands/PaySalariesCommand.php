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
            $payerAccount = BankAccount::model()->FindByAttributes(array('bank_user_id'=>$bankUser->id, 'bank_account_type_id'=>1, 'status'=>'enabled'));
            if(empty($payerAccount)){
                echo( "Company has no bank account. Skipping\n" );
                continue;
            }
            // Get the latest cost-benefit calculation
            $criteria = new CDbCriteria();
            $criteria->addCondition("id={$company->id}");
            $criteria->order = 'create_date DESC';
            $CBC = CostbenefitCalculation::model()->find( $criteria );
            $CBCSalaries = CostbenefitItem::model()->findByAttributes( array('costbenefit_calculation_id'=>$CBC->id, 'costbenefit_item_type_id'=>2) );
            $CBCSideExpenses = CostbenefitItem::model()->findByAttributes( array('costbenefit_calculation_id'=>$CBC->id, 'costbenefit_item_type_id'=>8) );
            $recipientAccount = BankAccount::model()->findByPk(5); // @TODO: get the id from somewhere
            
            $amount = $CBCSalaries->value + $CBCSideExpenses->value;
            echo( "Payment amount $amount EUR\n" );
            
            // Do the payment
            $bankTransaction = new BankAccountTransaction;
            $bankTransaction->recipient_iban = $recipientAccount->iban;
            $bankTransaction->recipient_bic = $recipientAccount->bankBic->bic;
            $bankTransaction->recipient_name = $recipientAccount->bankUser->profile->company;
            $bankTransaction->payer_iban = $payerAccount->iban;
            $bankTransaction->payer_bic = $payerAccount->bankBic->bic;
            $bankTransaction->payer_name = $payerAccount->bankUser->profile->company;    
            $bankTransaction->event_date = date('d.m.Y');
            $bankTransaction->amount = $amount;
            $bankTransaction->message = "Futurality palkat, viikko ".date("W"); 
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