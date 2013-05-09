<?php
class CreateAction extends CAction
{
    /**
     * Lists all models.
     */
    public function run()
    {
        $controller=$this->getController();
    
        // 1. Check if orders are already made for this week
        
        // 2. Get supplier firms
        $futuralCompanies = Yii::app()->db->createCommand()
                ->select('tag, name')
                ->from('company')
                ->queryAll();
        
        $companyData=new CActiveDataProvider('Company');
        
        // 3. Get customer firms
        
        
        
        $model=new Order;
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Order']))
        {
                $model->attributes=$_POST['Order'];
                if($model->save())
                        $this->redirect(array('view','id'=>$model->id));
        }

        $controller->render('create',array(
                'model'=>$model,
                'companyData'=>$companyData,
        ));
    }
}
?>