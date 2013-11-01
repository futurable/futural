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

        // Get the salaries multiplier
        $salaryMultiplier = self::getMultiplierValue( $journalValues, array('500000') );
        if($debug) echo( "Salaries multiplier {$salaryMultiplier}\n" );
        
        // Get the communications multiplier
        $communicationsMultiplier = self::getMultiplierValue( $journalValues, array('703000') );
        if($debug) echo( "Communications multiplier {$communicationsMultiplier}\n" );
        
        // Get the facility multiplier
        $facilityMultiplier = self::getMultiplierValue( $journalValues, array('701010', '701080') );
        if($debug) echo( "Facility multiplier {$facilityMultiplier}\n" );
        
        // Get the others multiplier
        $othersMultiplier = self::getMultiplierValue( $journalValues, array('707010', '709100', '709115', '702070') );
        if($debug) echo( "Others multiplier {$othersMultiplier}\n" );
        
        // Get the remarks multiplier
        $remarkMultiplier = self::getRemarkMultiplier($company);
        if($debug) echo( "Remarks multiplier {$remarkMultiplier}\n" );

        // Calculate the final multiplier
        $orderValueMultiplier += $salaryMultiplier + $communicationsMultiplier + $facilityMultiplier + $othersMultiplier;
        $orderValueMultiplier = $orderValueMultiplier / 4; // Avg multiplier
        
        $orderValueMultiplier *= $remarkMultiplier; // Add remarks
        
        return $orderValueMultiplier;
    }
    
    private function getBaseLineValue($account){
        if(!is_int((int)$account)) die("Only accepting integers");
        
        $baseLineValues = array(
            '500000' => '40000', // Salaries
            '701010' => '3000', // Leases
            '701080' => '200', // Electricity
            '703000' => '800', // Communications
            '702070' => '300', // Insurances
            '707010' => '300', // Marketing
            '709100' => '300', // Other business expenses
            '709115' => '300', // Logistics and storage
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
            if(!isset($journalValues[$account])) $journalValues[$account] = 0;
            
            $journalValue = abs($journalValues[$account]);
            $baseLine = self::getBaseLineValue($account);
            $factor += $journalValue / ($baseLine/10);
            $divider++;
        }
        $factor = $factor/$divider;
        
        if($factor<8) $factor = 8; // Minimum factor
        if($factor>15) $factor = 15; // Maximum factor
        
        $multiplier = log10($factor);
        
        return $multiplier;
    }
}
?>