<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tokenKey',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
    
    <?php echo $form->errorSummary($token); ?>
    
    <p><?php echo Yii::t('Company', 'PleaseGiveATokenKey'); ?>:</p>
    <p class="note"><?php echo Yii::t('Company', 'EachTokenKeyCanBeUsedOnlyOnce'); ?>.</p>

	<div class="row">
		<?php echo $form->labelEx($token,'token_key'); ?>
		<?php echo $form->textField($token,'token_key'); ?>
	</div>

	<div class="row buttons">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>Yii::t('Company', 'Verify') )); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->