<?php
class GetRealizedJournalValues {
    public function run(){
        // Get the realized sales
        $criteria=new CDbCriteria;
        $criteria->select='date_trunc(\'week\', create_date) AS week, account_id, SUM(credit) AS credit, SUM(debit) AS debit';
        $criteria->group='week, account_id';
        $criteria->order='week, account_id';

        $accountMoveLines = AccountMoveLine::model()->findAll($criteria);

        $realizedItemsArray = array();
        foreach($accountMoveLines as $accountMoveLine){
            $realizedItemsArray[ date('W', strtotime($accountMoveLine->week)) ][ $accountMoveLine->account->code ] = $accountMoveLine['credit'] - $accountMoveLine['debit'];
        }
        
        return $realizedItemsArray;
    }
}

?>
