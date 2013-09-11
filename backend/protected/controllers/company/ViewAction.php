<?php
class ViewAction extends CAction
{
    public function run($id)
    {
        $controller=$this->getController();
        $controller->allowUser(MANAGER);
        
        $action = isset($_GET['action']) ? $_GET['action'] : null;
        $company = $controller->loadModel($id);
        $bankUser = BankUser::model()->findByAttributes(array('username'=>$company->tag));
        
        // Change OpenERP-database
        Yii::app()->dbopenerp->setActive(false);
        Yii::app()->dbopenerp->connectionString = "pgsql:host=erp.futurality.fi;dbname={$company->tag}";
        Yii::app()->dbopenerp->setActive(true);

        $costBenefitCalculation = CostbenefitCalculation::model()->findByAttributes(array('company_id'=>$company->id));
        $costBenefitCalculationItems = array();
        foreach($costBenefitCalculation->costbenefitItems as $CBCItem){
            $key = $CBCItem->costbenefitItemType->name;
            $costBenefitCalculationItems[ $key ] = $CBCItem;
        };
        
        // Get the realized sales
        $criteria=new CDbCriteria;
        $criteria->select='account_id, sum(credit) AS credit, sum(debit) AS debit';
        $criteria->group='account_id';
        $criteria->order='account_id';
        
        $realizedItems = array();
        $accountMoveLines = AccountMoveLine::model()->findAll($criteria);
        foreach($accountMoveLines as $accountMoveLine){
            $realizedItems[ $accountMoveLine->account->code ] = $accountMoveLine['credit'] - $accountMoveLine['debit'];
        }

        $bankAccounts = BankAccount::model()->findAll(
            array(
                'condition'=>'bank_user_id=:bank_user_id', 
                'params'=>array('bank_user_id'=>$bankUser->id),
            )
        );
        
        $OEHrEmployees = HrEmployee::model()->findAll(array('order'=>'name_related'));
        $OESaleOrders = SaleOrder::model()->findAll(array('order'=>'create_date DESC'));
        $OEPurchaseOrders = PurchaseOrder::model()->findAll(array('order'=>'create_date DESC'));

        $controller->render('view',array(
            'action'=>$action,
            'company'=>$company,
            'costBenefitCalculationItems'=>$costBenefitCalculationItems,
            'realizedItems'=>$realizedItems,
            'bankAccounts'=>$bankAccounts,
            'OEHrEmployees'=>$OEHrEmployees,
            'OESaleOrders'=>$OESaleOrders,
            'OEPurchaseOrders'=>$OEPurchaseOrders,
        ));
    }
}
?>