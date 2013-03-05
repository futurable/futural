<?php
/* @var $this TokenKeyController */
/* @var $model TokenKey */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'token-key-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'TokenKey'); ?>
		<?php echo $form->textField($model,'TokenKey',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'TokenKey'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CreateDate'); ?>
		<?php echo $form->textField($model,'CreateDate'); ?>
		<?php echo $form->error($model,'CreateDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ReclaimDate'); ?>
		<?php echo $form->textField($model,'ReclaimDate'); ?>
		<?php echo $form->error($model,'ReclaimDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Lifetime'); ?>
		<?php echo $form->textField($model,'Lifetime'); ?>
		<?php echo $form->error($model,'Lifetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ExpirationDate'); ?>
		<?php echo $form->textField($model,'ExpirationDate'); ?>
		<?php echo $form->error($model,'ExpirationDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Token_Customer_ID'); ?>
		<?php echo $form->textField($model,'Token_Customer_ID'); ?>
		<?php echo $form->error($model,'Token_Customer_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Token_Settings_ID'); ?>
		<?php echo $form->textField($model,'Token_Settings_ID'); ?>
		<?php echo $form->error($model,'Token_Settings_ID'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->