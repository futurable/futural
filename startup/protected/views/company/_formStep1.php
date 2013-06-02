<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tokenKey',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
    
    <?php echo $form->errorSummary($token); ?>
    
    <p>Please give a token key:</p>
    <p class="note">Each token key can be used only once.</p>

	<div class="row">
		<?php echo $form->labelEx($token,'token_key'); ?>
		<?php echo $form->textField($token,'token_key'); ?>
		<?php echo $form->error($token,'token_key'); ?>
	</div>

	<div class="row buttons">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>"Verify")); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->