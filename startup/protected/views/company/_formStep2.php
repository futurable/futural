<?php
/* @var $this CompanyController */
/* @var $model Company */
/* @var $form CActiveForm */
?>

<div class="form">

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
		<?php echo $form->labelEx($company,'company_name'); ?>
		<?php echo $form->textField($company,'company_name',array('size'=>30,'maxlength'=>256)); ?>
		<?php echo $form->error($company,'company_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($company,'industry_id'); ?>
                <?php echo $form->dropDownList($company, 'industry_id', CHtml::listData(Industry::model()->findAll(array('order'=>'Name')),'id','name'),array('prompt'=>'- Select industry -'));?>
		<?php echo $form->error($company,'industry_id'); ?>
	</div>
        
        <div class="row">
            <p>Cost-benefit calculation</p>
            <table>
                <tr>
                    <th></th>
                    <th>Monthly</th>
                    <th>Yearly</th>
                    <th/>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($costBenefitItem_turnover,'Turnover'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_turnover,'value'); ?></td>
                    <td><?php echo CHtml::textField('turnover', ''); ?></td>
                    <td><?php echo $form->error($costBenefitItem_turnover,'value'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($costBenefitItem_salaries,'Salaries'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_salaries,'value'); ?></td>
                    <td><?php echo CHtml::textField('salaries', ''); ?></td>
                    <td><?php echo $form->error($costBenefitItem_salaries,'value'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($costBenefitItem_expenses,'Expenses'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_expenses,'value'); ?></td>
                    <td><?php echo CHtml::textField('expenses', ''); ?></td>
                    <td><?php echo $form->error($costBenefitItem_expenses,'value'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($costBenefitItem_loans,'Loans'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_loans,'value'); ?></td>
                    <td><?php echo CHtml::textField('loans', ''); ?></td>
                    <td><?php echo $form->error($costBenefitItem_loans,'value'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($costBenefitItem_rents,'Rents'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_rents,'value'); ?></td>
                    <td><?php echo CHtml::textField('rents', ''); ?></td>
                    <td><?php echo $form->error($costBenefitItem_rents,'value'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($costBenefitItem_communication,'Communication'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_communication,'value'); ?></td>
                    <td><?php echo CHtml::textField('communication', ''); ?></td>
                    <td><?php echo $form->error($costBenefitItem_communication,'value'); ?></td>
                </tr>
            </table>
        </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($company->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->