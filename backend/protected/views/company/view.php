<?php 
    $this->renderPartial('_viewCompanyInfo',array(
	'company'=>$company,
    ));
    
   $this->renderPartial('_viewBankAccounts',array(
	'bankAccounts'=>$bankAccounts,
    ));
   
    $this->renderPartial('_viewOpenErpInfo',array(
        'OEHrEmployees'=>$OEHrEmployees,
        'OESaleOrders'=>$OESaleOrders,
        'OEPurchaseOrders'=>$OEPurchaseOrders,
    ));
    
    $this->menu=array(
        array('label'=>'Company Info', 'url'=>array("/company/view", 'id' => $company->id)),
        array('label'=>'Bank Accounts', 'url'=>array("/company/view", 'id' => $company->id, 'action'=>'bankAccounts')),
        array('label'=>'Employees', 'url'=>array("/company/view", 'id' => $company->id, 'action'=>'employees')),
        array('label'=>'Sale orders', 'url'=>array("/company/view", 'id' => $company->id, 'action'=>'saleOrders')),
        array('label'=>'Purchase orders', 'url'=>array("/company/view", 'id' => $company->id, 'action'=>'purchaseOrders')),
    );


?>