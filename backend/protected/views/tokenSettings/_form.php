<?php
/* @var $this TokenSettingsController */
/* @var $model TokenSettings */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'token-settings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Description'); ?>
		<?php echo $form->textField($model,'Description',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'Description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CreateInitData'); ?>
		<?php echo $form->textField($model,'CreateInitData'); ?>
		<?php echo $form->error($model,'CreateInitData'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CreateDemoData'); ?>
		<?php echo $form->textField($model,'CreateDemoData'); ?>
		<?php echo $form->error($model,'CreateDemoData'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CreatePurchasingOrders'); ?>
		<?php echo $form->textField($model,'CreatePurchasingOrders'); ?>
		<?php echo $form->error($model,'CreatePurchasingOrders'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Token_Customer_ID'); ?>
		<?php echo $form->textField($model,'Token_Customer_ID'); ?>
		<?php echo $form->error($model,'Token_Customer_ID'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->