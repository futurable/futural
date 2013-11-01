<?php
class OrderValueMultiplier{
    public function get(Company $company, $debug = false){
        if(!is_a($company, 'Company')) die("Erronous class");
        
        // Change OpenERP-database
        Yii::app()->dbopenerp->setActive(false);
        Yii::app()->dbopenerp->connectionString = "pgsql:host=erp.futurality.fi;dbname={$company->tag}";
        Yii::app()->dbopenerp->setActive(true);

        $orderValueMultiplier = 1;
        $journalValues = GetRealizedJournalValues::run();

        // Remarks
        $remarkMultiplier = self::getRemarkMultiplier($company);
        if($debug) echo( "Remarks multiplier {$remarkMultiplier}\n");
        
        return $orderValueMultiplier;
    }
    
    private function getBaseLineValues(){
        $baseLineValues = array(
            
        );
        
        return $baseLineValues;
    }
    
    private function getRemarkMultiplier(Company $company){
        $criteria = new CDbCriteria();
        $criteria->select = "SUM(significance) significance";
        $criteria->addCondition("company_id={$company->id}");
        
        $remarks = Remark::model()->find($criteria);
        $remarkMultiplier = 1+($remarks['significance']/100);
        
        return $remarkMultiplier;
    }
}
?>