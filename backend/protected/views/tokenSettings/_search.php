<?php
/* @var $this TokenSettingsController */
/* @var $model TokenSettings */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID'); ?>
		<?php echo $form->textField($model,'ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Description'); ?>
		<?php echo $form->textField($model,'Description',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CreateInitData'); ?>
		<?php echo $form->textField($model,'CreateInitData'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CreateDemoData'); ?>
		<?php echo $form->textField($model,'CreateDemoData'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CreatePurchasingOrders'); ?>
		<?php echo $form->textField($model,'CreatePurchasingOrders'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Token_Customer_ID'); ?>
		<?php echo $form->textField($model,'Token_Customer_ID'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->