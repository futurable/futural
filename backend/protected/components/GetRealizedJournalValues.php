<?php
class GetRealizedJournalValues {
    public function run($byWeek = true, $intervalMonths = false){
        if($intervalMonths == false OR !is_int($intervalMonths)) $intervalMonths = '6';
        
        // Get the realized sales
        $criteria=new CDbCriteria;
        $criteria->addCondition("create_date > NOW()::date - INTERVAL '{$intervalMonths} month'");
        
        if($byWeek === true){
            $criteria->select='date_trunc(\'week\', create_date) AS week, account_id, SUM(credit) AS credit, SUM(debit) AS debit';  
            $criteria->group='week, account_id';
            $criteria->order='week, account_id';
        }
        else{
            $criteria->select = 'account_id, SUM(credit) AS credit, SUM(debit) AS debit';
            $criteria->group='account_id';
            $criteria->order='account_id';
        }

        $accountMoveLines = AccountMoveLine::model()->findAll($criteria);

        $realizedItemsArray = array();
        
        if($byWeek === true){
            foreach($accountMoveLines as $accountMoveLine){
                $realizedItemsArray[ date('W', strtotime($accountMoveLine->week)) ][ $accountMoveLine->account->code ] = $accountMoveLine['credit'] - $accountMoveLine['debit'];
            }
        }
        else{
            foreach($accountMoveLines as $accountMoveLine){
                $realizedItemsArray[$accountMoveLine->account->code ] = $accountMoveLine['credit'] - $accountMoveLine['debit'];
            }
        }
        
        return $realizedItemsArray;
    }
}

?>
