<?php
/* @var $this TokenKeyController */
/* @var $model TokenKey */
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
		<?php echo $form->label($model,'token_key'); ?>
		<?php echo $form->textField($model,'token_key',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lifetime'); ?>
		<?php echo $form->textField($model,'lifetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reclaim_date'); ?>
		<?php echo $form->textField($model,'reclaim_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'expiration_date'); ?>
		<?php echo $form->textField($model,'expiration_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'token_customer_id'); ?>
		<?php echo $form->textField($model,'token_customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'token_setup_id'); ?>
		<?php echo $form->textField($model,'token_setup_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->