<?php
/* @var $this TokenKeyController */
/* @var $model TokenKey */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'token-key-form',
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
                <?php //echo $form->dropDownList($model, 'Token_Customer_ID', CHtml::listData(TokenCustomer::model()->findAll(array('order'=>'Name')),'ID','Name'));?>
 
                <?php echo $form->dropDownList($model, 'Token_Customer_ID', CHtml::listData(TokenCustomer::model()->findAll(array('order'=>'Name')),'ID','Name'),
                        array(
                            'prompt'=>'- Select customer -',
                            'ajax'=>array(
                                    'type'=>'POST', //request type
                                    'url'=>CController::createUrl('dynamicSettings'), //url to call.
                                    'update'=>'#Token_Settings_ID',
                                )
                            ));?>
		<?php echo $form->error($model,'Token_Customer_ID'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'Token_Settings_ID'); ?>
                <?php echo CHtml::dropDownList('Token_Settings_ID','', array()); ?>
		<?php //echo $form->dropDownList($model, 'Token_Settings_ID', CHtml::listData(TokenSettings::model()->findAll(array('order'=>'ID')),'ID','Description'));?>
		<?php echo $form->error($model,'Token_Settings_ID'); ?>
	</div>
        
	<div class="row">
		<?php $randomKey = uniqid();?>
		<?php echo $form->labelEx($model,'TokenKey'); ?>
		<?php echo $form->textField($model,'TokenKey',array('size'=>16,'maxlength'=>16, 'value'=>$randomKey)); ?>
		<?php echo $form->error($model,'TokenKey'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Lifetime'); ?>
		<?php echo $form->textField($model,'Lifetime'); ?>
		<?php echo $form->error($model,'Lifetime'); ?>
	</div>	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->