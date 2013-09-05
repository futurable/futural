<?php
class ViewAction extends CAction
{
    public function run($id)
    {
        $controller=$this->getController();
        
        $company = $controller->loadModel($id);
        $bankUser = BankUser::model()->findByAttributes(array('username'=>$company->tag));

        $bankAccounts = BankAccount::model()->findAll(
            array(
                'condition'=>'bank_user_id=:bank_user_id', 
                'params'=>array('bank_user_id'=>$bankUser->id),
            )
        );

        // Change OpenERP-database
        Yii::app()->dbopenerp->setActive(false);
        Yii::app()->dbopenerp->connectionString = "pgsql:host=erp.futurality.fi;dbname={$company->tag}";
        Yii::app()->dbopenerp->setActive(true);
        
        $OEHrEmployees = HrEmployee::model()->findAll(array('order'=>'name_related'));
        $OESaleOrders = SaleOrder::model()->findAll(array('order'=>'create_date DESC'));

        $controller->render('view',array(
            'company'=>$company,
            'bankAccounts'=>$bankAccounts,
            'OEHrEmployees'=>$OEHrEmployees,
            'OESaleOrders'=>$OESaleOrders,
        ));
    }
}
?>