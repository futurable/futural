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
		<?php echo $form->label($model,'ID'); ?>
		<?php echo $form->textField($model,'ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TokenKey'); ?>
		<?php echo $form->textField($model,'TokenKey',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CreateDate'); ?>
		<?php echo $form->textField($model,'CreateDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ReclaimDate'); ?>
		<?php echo $form->textField($model,'ReclaimDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Lifetime'); ?>
		<?php echo $form->textField($model,'Lifetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ExpirationDate'); ?>
		<?php echo $form->textField($model,'ExpirationDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Token_Customer_ID'); ?>
		<?php echo $form->textField($model,'Token_Customer_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Token_Settings_ID'); ?>
		<?php echo $form->textField($model,'Token_Settings_ID'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->