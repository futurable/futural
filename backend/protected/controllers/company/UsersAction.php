<?php
class UsersAction extends CAction
{
    public function run()
    {
        $controller=$this->getController();
        $controller->allowUser(MANAGER);
        
        // Get all companies
        $companies = Suppliers::get();

        $companyArray = array();
        foreach($companies AS $company){
            // Switch to the right company
            Yii::app()->dbopenerp->setActive(false);
            Yii::app()->dbopenerp->connectionString = "pgsql:host=erp.futurality.fi;dbname={$company['tag']}";
            Yii::app()->dbopenerp->setActive(true);

            // Get the OpenERP-company
            $OECompany = ResCompany::model()->find();
            
            // Get company users
            $OEEmployees = HrEmployee::model()->findAll();
            
            $companyArray[$company->name]['company'] = $company;
            $companyArray[$company->name]['OECompany'] = $OECompany;
            $companyArray[$company->name]['OEEmployees'] = $OEEmployees;
        }
        
        $controller->render('users',array(
            'companies'=>$companyArray,
        ));
    }
}
?>