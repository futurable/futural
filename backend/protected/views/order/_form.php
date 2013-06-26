<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'execution_time'); ?>
		<?php echo $form->textField($model,'execution_time'); ?>
		<?php echo $form->error($model,'execution_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'executed'); ?>
		<?php echo $form->textField($model,'executed'); ?>
		<?php echo $form->error($model,'executed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rows'); ?>
		<?php echo $form->textField($model,'rows'); ?>
		<?php echo $form->error($model,'rows'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textField($model,'value',array('size'=>19,'maxlength'=>19)); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company_id'); ?>
		<?php echo $form->textField($model,'company_id'); ?>
		<?php echo $form->error($model,'company_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'order_setup_id'); ?>
		<?php echo $form->textField($model,'order_setup_id'); ?>
		<?php echo $form->error($model,'order_setup_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'order_automation_id'); ?>
		<?php echo $form->textField($model,'order_automation_id'); ?>
		<?php echo $form->error($model,'order_automation_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->