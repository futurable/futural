<?php
/* @var $this CompanyController */
/* @var $model Company */
/* @var $form CActiveForm */
?>

<div class="form">
    
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/costBenefitCalculation.js');
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tokenKey',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($company); ?>
        
	<div class="row">
                <?php echo $form->hiddenField($token, 'token_key', array('value'=>$token->token_key)); ?>
		<?php echo $form->labelEx($company,'name'); ?>
		<?php echo $form->textField($company,'name',array('size'=>30,'maxlength'=>256)); ?>
		<?php echo $form->error($company,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($company,'industry_id'); ?>
                <?php echo $form->dropDownList($company, 'industry_id', CHtml::listData(Industry::model()->findAll(array('order'=>'Name')),'id','name'),array('prompt'=>'- Select industry -'));?>
		<?php echo $form->error($company,'industry_id'); ?>
	</div>
        
        <div class="row">
            <p>Cost-benefit calculation</p>
            <table id='costBenefitCalculationTable'>
                <tr>
                    <th></th>
                    <th>Monthly</th>
                    <th>Yearly</th>
                    <th></th>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($costBenefitItem_turnover,'Turnover'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_turnover,'[turnover]value', array('value'=>0)); ?> &euro;</td>
                    <td><?php echo CHtml::textField('[turnover]yearly', 0); ?> &euro;</td>
                    <td><?php echo $form->error($costBenefitItem_turnover,'[turnover]value'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($costBenefitItem_salaries,'Salaries'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_salaries,'[salaries]value', array('value'=>0)); ?> &euro;</td>
                    <td><?php echo CHtml::textField('[salaries]yearly', 0); ?> &euro;</td>
                    <td><?php echo $form->error($costBenefitItem_salaries,'[salaries]value'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($costBenefitItem_expenses,'Expenses'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_expenses,'[expenses]value', array('value'=>0)); ?> &euro;</td>
                    <td><?php echo CHtml::textField('[expenses]yearly', 0); ?> &euro;</td>
                    <td><?php echo $form->error($costBenefitItem_expenses,'[expenses]value'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($costBenefitItem_loans,'Loans'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_loans,'[loans]value', array('value'=>0)); ?> &euro;</td>
                    <td><?php echo CHtml::textField('[loans]yearly', 0); ?> &euro;</td>
                    <td><?php echo $form->error($costBenefitItem_loans,'[loans]value'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($costBenefitItem_rents,'Rents'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_rents,'[rents]value', array('value'=>0)); ?> &euro;</td>
                    <td><?php echo CHtml::textField('[rents]yearly', 0); ?> &euro;</td>
                    <td><?php echo $form->error($costBenefitItem_rents,'[rents]value'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($costBenefitItem_communication,'Communication'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_communication,'[communication]value', array('value'=>0)); ?> &euro;</td>
                    <td><?php echo CHtml::textField('[communication]yearly', 0); ?> &euro;</td>
                    <td><?php echo $form->error($costBenefitItem_communication,'[communication]value'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($costBenefitItem_health,'Health'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_health,'[health]value', array('value'=>0)); ?> &euro;</td>
                    <td><?php echo CHtml::textField('[health]yearly', 0); ?> &euro;</td>
                    <td><?php echo $form->error($costBenefitItem_health,'[health]value'); ?></td>
                </tr>
            </table>
        </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($company->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->