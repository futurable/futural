<?php
/* @var $this CompanyController */
/* @var $model LoginForm */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'startup-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx(TokenKey::model(),'TokenKey'); ?>
		<?php echo $form->textField(TokenKey::model(),'TokenKey',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error(TokenKey::model(),'TokenKey'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->