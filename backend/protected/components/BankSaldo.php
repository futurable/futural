<?php
class BankSaldo {
    public function getAccountSaldo($iban, $end_date = false){     
        if(!DataValidator::isDateISOSyntaxValid($end_date)) $end_date = date('Y-m-d');
        
        // Count bank saldo
        $record = Yii::app()->dbbank->createCommand()
        ->select("sum(if( recipient_iban = '$iban', amount, -amount )) AS saldo")
        ->from('bank_account_transaction')
        ->where("event_date <= '$end_date'")
        ->andWhere("status = 'active'")
        ->andWhere("(payer_iban = '$iban' OR recipient_iban  = '$iban')")
        ->queryRow();
        
        if(empty($record['saldo'])) $record['saldo'] = "0.00";
        
        return $record['saldo'];
    }
    
    public function getSalaryPaymentsSaldo($loanAccounts, $week = false){
        $criteria = new CDbCriteria();

        foreach($loanAccounts as $key => $loanAccount){
            $loanAccounts[$key] = "'{$loanAccount}'";
        }
        $loanAccounts = implode(",", $loanAccounts);
        
        if($week == true){
            $criteria->addCondition("DATE_FORMAT(event_date, '%u') = {$week}");
        }
        
        $criteria->select = "SUM( IF(recipient_iban IN({$loanAccounts}), amount, -amount) ) AS amount";
        //$criteria->select = "SUM( IF(recipient_iban = '$iban', amount, -amount) ) AS saldo";
        $criteria->addCondition("recipient_iban IN({$loanAccounts}) OR payer_iban IN({$loanAccounts})");
        $criteria->addCondition("status='active'");
        $criteria->addCondition("event_date<NOW()");
        
        $record = BankAccountTransaction::model()->find($criteria);
        if(empty($record->amount)) $record->amount = "0.00";
        
        return $record->amount;
    }
}
?>
