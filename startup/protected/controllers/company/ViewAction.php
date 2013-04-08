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
            $industrySetups = IndustrySetup::model()->findByAttributes(array('setup_id'=>$industry->industrySetups));
            $CBC = CostbenefitCalculation::model()->findByAttributes(array('company_id'=>$id));
            $CBC_items = CostbenefitItem::model()->findAll( array(
                    'condition'=>'costbenefit_calculation_id=:CBCId',
                    'params'=>array(':CBCId'=>$CBC->id),
                    ));
            
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
