<?php
/* @var $this CompanyController */
/* @var $model Company */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'company-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'CompanyName'); ?>
		<?php echo $form->textField($model,'CompanyName',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'CompanyName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Industry_ID'); ?>
		<?php echo $form->textField($model,'Industry_ID'); ?>
		<?php echo $form->error($model,'Industry_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Token_Key_ID'); ?>
		<?php echo $form->textField($model,'Token_Key_ID'); ?>
		<?php echo $form->error($model,'Token_Key_ID'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->