<?php
/* @var $this CompanyController */
/* @var $model Company */
?>

<h1>Create Company</h1>

<?php 

if($company->form_step == 1) echo $this->renderPartial('_formStep1', array('token'=>$token));
elseif($company->form_step == 2) echo $this->renderPartial('_formStep2', 
        array(
            'token'=>$token, 
            'company'=>$company, 
            'industry'=>$industry,
            'costBenefitCalculation'=>$costBenefitCalculation,
            'costBenefitItem_turnover'=>$costBenefitItem_turnover,
            'costBenefitItem_salaries'=>$costBenefitItem_salaries,
            'costBenefitItem_expenses'=>$costBenefitItem_expenses,
            'costBenefitItem_loans'=>$costBenefitItem_loans,
            'costBenefitItem_rents'=>$costBenefitItem_rents,
            'costBenefitItem_communication'=>$costBenefitItem_communication,
            'costBenefitItem_health'=>$costBenefitItem_health,
        ));
else echo "Error while deciding form step";

?>