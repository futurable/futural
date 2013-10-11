<?php
class BankSaldo {
    public function getAccountSaldo($iban, $end_date = false){     
        if(!DataValidator::isDateISOSyntaxValid($end_date)) $end_date = date('Y-m-d');
        
        // Count bank saldo
        $record = Yii::app()->db->createCommand()
        ->select("sum(if( recipient_iban = '$iban', amount, -amount )) AS saldo")
        ->from('bank_account_transaction')
        ->where("event_date <= '$end_date'")
        ->andWhere("status = 'active'")
        ->andWhere("(payer_iban = '$iban' OR recipient_iban  = '$iban')")
        ->queryRow();
        
        if(empty($record['saldo'])) $record['saldo'] = "0.00";
        
        return $record['saldo'];
    } 
}
?>
