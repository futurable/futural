<?php
    if(!Yii::app()->user->isGuest) $role = Yii::app()->user->getRole();
    if($role>0){
        $menuItems = Suppliers::get();
        $subMenu = array();
        foreach($menuItems as $menuItem){
            $subMenu[] = array('label'=>$menuItem->name, 'url'=>array("/company/view", 'id' => $menuItem->id, 'action'=>$action));
        }

        echo "<div id='submenu'>";
            $this->widget('zii.widgets.CMenu',array(
                'items'=>$subMenu,
            ));
        echo "</div>";
    }

    $this->menu=array(
        array('label'=>Yii::t('Company', 'CompanyInfo'), 'url'=>array("/company/view", 'id' => $company->id, 'action'=>'info')),
        array('label'=>Yii::t('Company', 'CostBenefitCalculation'), 'url'=>array("/company/view", 'id' => $company->id, 'action'=>'costBenefitCalculation')),
        array('label'=>Yii::t('Company', 'BankAccounts'), 'url'=>array("/company/view", 'id' => $company->id, 'action'=>'bankAccounts')),
        array('label'=>Yii::t('Company', 'CustomerPayments'), 'url'=>array("/company/view", 'id' => $company->id, 'action'=>'CustomerPayments'), 'visible'=>$role>0),
        array('label'=>Yii::t('Company', 'Employees'), 'url'=>array("/company/view", 'id' => $company->id, 'action'=>'employees')),
        array('label'=>Yii::t('Company', 'SaleOrders'), 'url'=>array("/company/view", 'id' => $company->id, 'action'=>'saleOrders')),
        array('label'=>Yii::t('Company', 'PurchaseOrders'), 'url'=>array("/company/view", 'id' => $company->id, 'action'=>'purchaseOrders')),
        array('label'=>Yii::t('Company', 'AutomatedOrders'), 'url'=>array("/company/view", 'id' => $company->id, 'action'=>'automatedOrders'), 'visible'=>$role>0),
        array('label'=>Yii::t('Company', 'Remarks'), 'url'=>array("/company/view", 'id' => $company->id, 'action'=>'remarks')),
    );

    echo "<h1>{$company->name}</h1>";
    
    if($action=='info' OR $action=='null'){
        $this->renderPartial('_viewCompanyInfo',array(
        'company'=>$company,
        ));
    }
    elseif($action=='costBenefitCalculation'){
        $this->renderPartial('_viewCostBenefitCalculation',array(
            'costBenefitCalculations'=>$costBenefitCalculations,
            'realizedItemsArray' => $realizedItemsArray,
            'bankAccounts' => $bankAccounts,
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
        $this->renderPartial('_viewOpenErpSaleOrders',array(
            'OESaleOrders'=>$OESaleOrders,
            'OEPurchaseOrders'=>$OEPurchaseOrders,
        ));
    }
    elseif($action=='purchaseOrders'){
        $this->renderPartial('_viewOpenErpPurchaseOrders',array(
            'OEPurchaseOrders'=>$OEPurchaseOrders,
        ));
    }
    elseif($action=='remarks'){
        $this->renderPartial('_viewRemarks',array(
            'remarks'=>$remarks,
            'newRemark'=>$newRemark,
        ));
    }
    elseif($action=='automatedOrders'){
        $this->renderPartial('_viewAutomatedOrders',array(
            'automatedOrders'=>$automatedOrders,
        ));
    }
    elseif($action=='CustomerPayments'){
        $this->renderPartial('_viewCustomerPayments',array(
            'CustomerPayments'=>$CustomerPayments,
        ));
    }
    
    echo CHtml::link(Yii::t('Menu', 'Back'),array('company/index'),array('class'=>'btn'));
?>