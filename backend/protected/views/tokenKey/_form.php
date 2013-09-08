<?php
/* @var $this TokenKeyController */
/* @var $model TokenKey */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'token-key-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'token_key'); ?>
		<?php echo $form->textField($model,'token_key',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'token_key'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lifetime'); ?>
		<?php echo $form->textField($model,'lifetime'); ?>
		<?php echo $form->error($model,'lifetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
		<?php echo $form->error($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reclaim_date'); ?>
		<?php echo $form->textField($model,'reclaim_date'); ?>
		<?php echo $form->error($model,'reclaim_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expiration_date'); ?>
		<?php echo $form->textField($model,'expiration_date'); ?>
		<?php echo $form->error($model,'expiration_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'token_customer_id'); ?>
		<?php echo $form->textField($model,'token_customer_id'); ?>
		<?php echo $form->error($model,'token_customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'token_setup_id'); ?>
		<?php echo $form->textField($model,'token_setup_id'); ?>
		<?php echo $form->error($model,'token_setup_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->