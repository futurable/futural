<?php
/* @var $this CompanyController */
/* @var $model Company */
/* @var $form CActiveForm */
?>

<div class="form">
    
<?php
$IndustryDescriptionArray = CJSON::encode(CHtml::listData(Industry::model()->findAll(array('order'=>'Name')),'id','description'));
$IndustryDescriptionJS = "var IndustryDescriptionArray = $IndustryDescriptionArray;\n";

$IndustrySetupArray = CJSON::encode(CHtml::listData(IndustrySetup::model()->findAll(),'turnover','minimum_wage_rate','average_wage_rate','maximum_wage_rate', 'rents', 'communications'));
$IndustrySetupJS = "var IndustrySetupArray = $IndustrySetupArray;\n";

Yii::app()->clientScript->registerScript('IndustryDescription', $IndustryDescriptionJS, CClientScript::POS_HEAD);

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
		<?php echo $form->labelEx($company,'email'); ?>
		<?php echo $form->textField($company,'email',array('size'=>30,'maxlength'=>256)); ?>
		<?php echo $form->error($company,'email'); ?>
	</div>
        
        <div class="row">
                <?php echo CHtml::label("Employees", "employees");?>
		<?php echo CHtml::dropDownList('Company_employees', 'Company_employees', array_merge( range(1,9),range(10,100,10)) ); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($company,'industry_id'); ?>
                <?php echo $form->dropDownList($company, 'industry_id', CHtml::listData(Industry::model()->findAll(array('order'=>'Name')),'id','name'),array('prompt'=>'- Select industry -'));?>
		<?php echo $form->error($company,'industry_id'); ?>
                <span id="Company_industry_description"></span>
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
                    <td><?php echo $form->textField($costBenefitItem_turnover,'[turnover]value'); ?> &euro;</td>
                    <td><?php echo CHtml::textField('[turnover]yearly'); ?> &euro;</td>
                    <td><?php echo $form->error($costBenefitItem_turnover,'[turnover]value'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($costBenefitItem_expenses,'Expenses'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_expenses,'[expenses]value'); ?> &euro;</td>
                    <td><?php echo CHtml::textField('[expenses]yearly'); ?> &euro;</td>
                    <td><?php echo $form->error($costBenefitItem_expenses,'[expenses]value'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($costBenefitItem_salaries,'Salaries'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_salaries,'[salaries]value'); ?> &euro;</td>
                    <td><?php echo CHtml::textField('[salaries]yearly'); ?> &euro;</td>
                    <td><?php echo $form->error($costBenefitItem_salaries,'[salaries]value'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($costBenefitItem_loans,'Loans'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_loans,'[loans]value'); ?> &euro;</td>
                    <td><?php echo CHtml::textField('[loans]yearly'); ?> &euro;</td>
                    <td><?php echo $form->error($costBenefitItem_loans,'[loans]value'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($costBenefitItem_rents,'Rents'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_rents,'[rents]value'); ?> &euro;</td>
                    <td><?php echo CHtml::textField('[rents]yearly'); ?> &euro;</td>
                    <td><?php echo $form->error($costBenefitItem_rents,'[rents]value'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($costBenefitItem_communication,'Communication'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_communication,'[communication]value'); ?> &euro;</td>
                    <td><?php echo CHtml::textField('[communication]yearly'); ?> &euro;</td>
                    <td><?php echo $form->error($costBenefitItem_communication,'[communication]value'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($costBenefitItem_health,'Health'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_health,'[health]value'); ?> &euro;</td>
                    <td><?php echo CHtml::textField('[health]yearly'); ?> &euro;</td>
                    <td><?php echo $form->error($costBenefitItem_health,'[health]value'); ?></td>
                </tr>
            </table>
        </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($company->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->