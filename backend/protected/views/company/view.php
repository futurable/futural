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
    ));
?>