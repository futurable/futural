<?php
    $this->menu=array(
        array('label'=>'Company Info', 'url'=>array("/company/view", 'id' => $company->id)),
        array('label'=>'Bank Accounts', 'url'=>array("/company/view", 'id' => $company->id, 'action'=>'bankAccounts')),
        array('label'=>'Employees', 'url'=>array("/company/view", 'id' => $company->id, 'action'=>'employees')),
        array('label'=>'Sale orders', 'url'=>array("/company/view", 'id' => $company->id, 'action'=>'saleOrders')),
        array('label'=>'Purchase orders', 'url'=>array("/company/view", 'id' => $company->id, 'action'=>'purchaseOrders')),
    );

    if($action==null){
        $this->renderPartial('_viewCompanyInfo',array(
        'company'=>$company,
        ));
    }
    elseif($action=='bankAccounts'){
        $this->renderPartial('_viewBankAccounts',array(
            'bankAccounts'=>$bankAccounts,
        ));
    }
    elseif($action=='employees'){
        $this->renderPartial('_viewOpenErpEmployees',array(
            'OEHrEmployees'=>$OEHrEmployees,
        ));
    }
    elseif($action=='saleOrders'){
        $this->renderPartial('_viewOpenErpInfo',array(
            'OESaleOrders'=>$OESaleOrders,
            'OEPurchaseOrders'=>$OEPurchaseOrders,
        ));
    }
    elseif($action=='purchaseOrders'){
        $this->renderPartial('_viewOpenErpInfo',array(
            'OEPurchaseOrders'=>$OEPurchaseOrders,
        ));
    }
?>