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
        $supplierCompanies = Yii::app()->db->createCommand()
                ->select('tag, name')
                ->from('company')
                ->queryAll();
        
        // Get supplier names in array
        $supplierNames = null;
        foreach($supplierCompanies as $company){
            $supplierNames.="$company[tag],";
        }
        $supplierNames = substr($supplierNames, 0, -1);
        
        $supplierOpenerp = Yii::app()->dbopenerp->createCommand()
            ->select('datname')
            ->from('pg_database')
            ->where('datistemplate = false AND datname = ANY(\'{'.$supplierNames.'}\')')
            ->queryAll();

        $supplierData=new CActiveDataProvider('Company');

        // 3. Get customer firms
        $customerCompanies = Yii::app()->dbopenerp->createCommand()
            ->select('name')
            ->from('res_company')
            ->queryAll();
          
        $customerData=new CActiveDataProvider('ResCompany');
        
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
                'customerData'=>$customerData,
                'supplierData'=>$supplierData
        ));
    }
}
?>