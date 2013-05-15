<?php
/* @var $this OrderController */
/* @var $model Order */
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
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'execution_time'); ?>
		<?php echo $form->textField($model,'execution_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'executed'); ?>
		<?php echo $form->textField($model,'executed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rows'); ?>
		<?php echo $form->textField($model,'rows'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'value'); ?>
		<?php echo $form->textField($model,'value',array('size'=>19,'maxlength'=>19)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'company_id'); ?>
		<?php echo $form->textField($model,'company_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'order_setup_id'); ?>
		<?php echo $form->textField($model,'order_setup_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'order_automation_id'); ?>
		<?php echo $form->textField($model,'order_automation_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->