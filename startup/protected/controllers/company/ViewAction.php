<?php
class ViewAction extends CAction
{
    
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function run($id)
    {
        if(!is_int((int)$id)) exit;
        
            $controller=$this->getController();
            
            $company = Company::model()->findByPk($id);
            $industry = Industry::model()->findByPk($company->industry_id);
            $industrySetups = $industry->industrySetups;
            $CBC = CostbenefitCalculation::model()->findByAttributes(array('company_id'=>$id));
            $CBC_items = $CBC->costbenefitItems;
            
            $controller->render('view',array(
                'company'=>$company,
                'industry'=>$industry,
                'industrySetups'=>$industrySetups,
                'CBC'=>$CBC,
                'CBC_items'=>$CBC_items,
            ));
    }
}
?>
