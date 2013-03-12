<?php
/* @var $this CompanyController */
/* @var $model Company */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'company_name'); ?>
		<?php echo $form->textField($model,'company_name',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'token_key_id'); ?>
		<?php echo $form->textField($model,'token_key_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'industry_id'); ?>
		<?php echo $form->textField($model,'industry_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'costbenefit_calculation_id'); ?>
		<?php echo $form->textField($model,'costbenefit_calculation_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->