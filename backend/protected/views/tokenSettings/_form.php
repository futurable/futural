<?php
/* @var $this TokenSettingsController */
/* @var $model TokenSettings */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'token-settings-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions' => array(
			'validateOnType'=>true,
			'validateOnChange'=>true,
			'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Token_Customer_ID'); ?>
    	<?php echo $form->dropDownList($model, 'Token_Customer_ID', CHtml::listData(TokenCustomer::model()->findAll(array('order'=>'Name')),'ID','Name'),
                array('prompt'=>'- Select customer -'));?>	
    	<?php echo $form->error($model,'Token_Customer_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CreateInitData'); ?>
		<?php echo $form->checkBox($model, 'CreateInitData'); ?>
		<?php echo $form->error($model,'CreateInitData'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CreateDemoData'); ?>
		<?php echo $form->checkBox($model, 'CreateDemoData'); ?>
		<?php echo $form->error($model,'CreateDemoData'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CreatePurchasingOrders'); ?>
		<?php echo $form->checkBox($model, 'CreatePurchasingOrders'); ?>
		<?php echo $form->error($model,'CreatePurchasingOrders'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->