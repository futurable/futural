<?php
class PaySalariesCommand extends CConsoleCommand
{
    public function run($args)
    {   
        echo( date('Y-m-d H:i:s').": PaySalaries run started.\n" );

        # 1. Get all companies
        $companies = Company::model()->findAll(array('condition'=>'active=1'));
        
        echo( "Found ".count($companies)." companies\n");
        
        # 2. Run through each company
        foreach($companies as $company){
            echo( "Using company {$company->name}\n");
            
            # 3. Check if there are salaries to be paid
            $criteria = new CDbCriteria();
            $criteria->addCondition("company_id={$company->id}");
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
            $criteria->addCondition("company_id={$company->id}");
            $criteria->order = 'create_date DESC';
            $CBC = CostbenefitCalculation::model()->find( $criteria );
            if(empty($CBC)){
                echo( "No cost-benefit calculation found. Skipping\n" );
                continue;
            }
            
            $CBCSalaries = CostbenefitItem::model()->findByAttributes( array('costbenefit_calculation_id'=>$CBC->id, 'costbenefit_item_type_id'=>2) );
            $CBCSideExpenses = CostbenefitItem::model()->findByAttributes( array('costbenefit_calculation_id'=>$CBC->id, 'costbenefit_item_type_id'=>8) );
            $recipientAccount = BankAccount::model()->findByPk(5); // @TODO: get the id from somewhere
            
            $amount = $CBCSalaries->value + $CBCSideExpenses->value;
            echo( "Payment amount $amount EUR\n" );
            
            // Do the payment
            $bankTransaction = new BankAccountTransaction;
            $bankTransaction->recipient_iban = $recipientAccount->iban;
            $bankTransaction->recipient_bic = $recipientAccount->bankBic->bic;
            $bankTransaction->recipient_name = $recipientAccount->bankUser->bankProfile->company;
            $bankTransaction->payer_iban = $payerAccount->iban;
            $bankTransaction->payer_bic = $payerAccount->bankBic->bic;
            $bankTransaction->payer_name = $payerAccount->bankUser->bankProfile->company;    
            $bankTransaction->event_date = date('Y-m-d');
            $bankTransaction->amount = $amount;
            $bankTransaction->message = "Futurality palkat ja sivukulut, viikko ".date("W");
            
            $transaction = Yii::app()->db->beginTransaction();
            $BTSuccess = $bankTransaction->save();
            
            // Mark the payment as done
            $salary = new Salary();
            $salary->company_id = $company->id;
            $salary->employees = $company->employees;
            $salary->amount = $amount;
            $salary->week = date('W');
            $salary->year = date('Y');
            $salary->bank_transaction_id = $bankTransaction->id;
            
            $SSuccess = $salary->save();
            
            if($BTSuccess AND $SSuccess){
                echo( "Transaction successful\n" );
                $transaction->commit();
            }
            else{
                echo( "Transaction failed\n" );
                $transaction->rollback();
            }
        }
        
        echo( date('Y-m-d H:i:s').": PaySalaries run ended.\n\n" );
    }
}