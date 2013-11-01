<?php
class OrderValueMultiplier{
    public function get(Company $company, $debug = false){
        if(!is_a($company, 'Company')) die("Erronous class");
        
        // Change OpenERP-database
        Yii::app()->dbopenerp->setActive(false);
        Yii::app()->dbopenerp->connectionString = "pgsql:host=erp.futurality.fi;dbname={$company->tag}";
        Yii::app()->dbopenerp->setActive(true);

        $orderValueMultiplier = 0;
        $journalValues = GetRealizedJournalValues::run(false, '1');

        // Get facility expenses
        $facilityMultiplier = self::getMultiplierValue( $journalValues, array('701010', '701080') );
        if($debug) echo( "Facility multiplier {$facilityMultiplier}\n" );
        
        // Remarks
        $remarkMultiplier = self::getRemarkMultiplier($company);
        if($debug) echo( "Remarks multiplier {$remarkMultiplier}\n" );

        // Calculate the final multiplier
        $orderValueMultiplier += $remarkMultiplier + $facilityMultiplier;
        $orderValueMultiplier = $orderValueMultiplier / 2; // Avg multiplier
        
        return $orderValueMultiplier;
    }
    
    private function getBaseLineValue($account){
        if(!is_int((int)$account)) die("Only accepting integers");
        
        $baseLineValues = array(
            '701010' => '3000', // Leases
            '701080' => '200', // Electricity
        );
        
        $baseLine = $baseLineValues[$account];
        
        return $baseLine;
    }
    
    private function getRemarkMultiplier(Company $company){
        $criteria = new CDbCriteria();
        $criteria->select = "SUM(significance) significance";
        $criteria->addCondition("company_id={$company->id}");
        
        $remarks = Remark::model()->find($criteria);
        $remarkMultiplier = 1+($remarks['significance']/100);
        
        return $remarkMultiplier;
    }
    
    private function getMultiplierValue($journalValues, $accounts){
        if(!is_array($accounts)) die("Only accepting arrays");
        
        $factor = 0;
        $divider = 0;
        foreach($accounts as $account){
            $baseLine = self::getBaseLineValue($account);
            $factor += abs($journalValues[$account]) / ($baseLine/10);
            $divider++;
        }
        $factor = $factor/$divider;
        
        if($factor<5) $factor = 5; // Minimum factor
        if($factor>15) $factor = 15; // Maximum factor
        
        $multiplier = log10($factor);
        
        return $multiplier;
    }
}
?>