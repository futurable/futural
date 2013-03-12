<?php
/* @var $this CompanyController */
/* @var $model Company */
?>

<h1>Create Company</h1>

<?php 

if($model->form_step == 1) echo $this->renderPartial('_verifyForm', array('model'=>$model));
elseif($model->form_step == 2) echo $this->renderPartial('_form', array('model'=>$model));

?>