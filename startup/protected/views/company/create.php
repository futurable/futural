<?php
/* @var $this CompanyController */
/* @var $model Company */
?>

<h1>Create Company</h1>

<?php 

if($company->form_step == 1) echo $this->renderPartial('_formStep1', array('token'=>$token));
elseif($company->form_step == 2) echo $this->renderPartial('_formStep2', array('company'=>$company, 'industry'=>$industry));
else echo "Error while deciding form step";

?>