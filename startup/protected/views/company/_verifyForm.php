<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tokenKey',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
    
    <p>Please give a token key:</p>
    <p class="note">Each token key can be used only once.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'token_key'); ?>
		<?php echo $form->textField($model,'token_key'); ?>
		<?php echo $form->error($model,'token_key'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Verify'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->