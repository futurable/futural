<?php
/* @var $this CompanyController */
/* @var $model Company */
/* @var $form CActiveForm */
?>

<div class="form">
    
<?php
// Get industry descriptions
$industries = Industry::model()->findAll(array('order'=>'Name'));
foreach($industries AS $industry){
    $IndustryDescriptionArray[$industry->id] = $industry->description;
}
$IndustryDescriptionJSON = CJSON::encode($IndustryDescriptionArray);
$IndustryDescriptionJS = "var IndustryDescriptionArray = $IndustryDescriptionJSON;\n";

// Get industry setups
$industrySetups = IndustrySetup::model()->findAll();
foreach($industrySetups as $industrySetup){
    $IndustrySetupArray[$industrySetup->industry_id] = array(
                                            'turnover' => $industrySetup->turnover,
                                            'minWage' => $industrySetup->minimum_wage_rate,
                                            'avgWage' => $industrySetup->average_wage_rate,
                                            'maxWage' => $industrySetup->maximum_wage_rate,
                                            'rents' => $industrySetup->rents,
                                            'communication' => $industrySetup->communication,
                                        );
}
$IndustrySetupJSON = CJSON::encode($IndustrySetupArray);
$IndustrySetupJS = "var IndustrySetupArray = $IndustrySetupJSON;\n";

Yii::app()->clientScript->registerScript('IndustryDescription', $IndustryDescriptionJS, CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScript('IndustrySetup', $IndustrySetupJS, CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/costBenefitCalculation.js');
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tokenKey',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
        
	<div class="row">
        <?php echo $form->hiddenField($token, 'token_key', array('value'=>$token->token_key)); ?>
		<?php echo $form->label($company,'name'); ?>
		<?php echo $form->textField($company,'name', 
            array(
                'size'=>30,
                'maxlength'=>256, 
                'rel'=>'tooltip', 
                'title'=>Yii::t('Company', 'TooltipCompanyName')
                )); ?>
		<?php echo $form->error($company,'name'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->label($company,'email'); ?>
		<?php echo $form->textField($company,'email',
            array(
                'size'=>30,
                'maxlength'=>256,
                'rel'=>'tooltip',
                'title'=>Yii::t('Company', 'TooltipEmail')
                )); ?>
		<?php echo $form->error($company,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($company,'industry_id'); ?>
        <?php echo $form->dropDownList($company, 'industry_id', CHtml::listData(Industry::model()->findAll(array('order'=>'Name')),'id','name'),
            array(
                'prompt'=> "- ".Yii::t('Company', 'SelectIndustry')." -",
                'rel'=>'tooltip',
                'title'=>Yii::t('Company', 'TooltipIndustry')
                )); ?>
		<?php echo $form->error($company,'industry_id'); ?>
                <span id="Company_industry_description"></span>
	</div>
        
        <div class="row">
                <?php echo $form->label($company, "employees");?>
		<?php echo $form->dropDownList($company, 'employees', array_merge( range(1,9),range(10,100,10)), 
            array(
                'rel'=>'tooltip',
                'title'=>Yii::t('Company', 'TooltipEmployees')
            )); ?>
	</div>
        
        <div class="row">
            <p>Cost-benefit calculation</p>
            <table id='costBenefitCalculationTable'>
                <tr>
                    <th></th>
                    <th>Monthly (&euro;)</th>
                    <th>Yearly (&euro;)</th>
                    <th></th>
                </tr>

                <tr class='green'>
                    <?php $tooltip = Yii::t('Company', 'ToolTipTurnover'); ?>
                    <td><?php echo $form->labelEx($costBenefitItem_turnover,'Turnover'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_turnover,'[turnover]value', 
                            array(
                                'rel'=>'tooltip',
                                'title'=>$tooltip
                            )); ?> 
                    </td>
                    <td><?php echo CHtml::textField('[turnover]yearly', false,
                            array(
                                'rel'=>'tooltip',
                                'title'=>$tooltip
                            )); ?>
                    </td>
                    <td><?php echo $form->error($costBenefitItem_turnover,'[turnover]value'); ?></td>
                </tr>
                
                <tr class='red'>
                    <?php $tooltip = Yii::t('Company', 'ToolTipExpenses'); ?>
                    <td><?php echo $form->labelEx($costBenefitItem_expenses,'Expenses'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_expenses,'[expenses]value', 
                        array(
                            'rel'=>'tooltip',
                            'title'=>$tooltip
                        )); ?>
                    </td>
                    <td><?php echo CHtml::textField('[expenses]yearly', false,
                        array(
                            'rel'=>'tooltip',
                            'title'=>$tooltip 
                        )); ?>
                    </td>
                    <td><?php echo $form->error($costBenefitItem_expenses,'[expenses]value'); ?></td>
                </tr>
                
                <tr class='red'>
                    <?php $tooltip = Yii::t('Company', 'ToolTipSalaries'); ?>
                    <td><?php echo $form->labelEx($costBenefitItem_salaries,'Salaries'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_salaries,'[salaries]value', 
                        array(
                            'rel'=>'tooltip',
                            'title'=>$tooltip
                        )); ?>
                    </td>
                    <td><?php echo CHtml::textField('[salaries]yearly', false,
                        array(
                            'rel'=>'tooltip',
                            'title'=>$tooltip 
                        )); ?>
                    </td>
                    <td><?php echo $form->error($costBenefitItem_salaries,'[salaries]value'); ?></td>
                </tr>
                
                <tr class='red'>
                    <?php $tooltip = Yii::t('Company', 'ToolTipSideExpenses'); ?>
                    <td><?php echo $form->labelEx($costBenefitItem_sideExpenses,'Side expenses'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_sideExpenses,'[sideExpenses]value', 
                        array(
                            'rel'=>'tooltip',
                            'title'=>$tooltip
                        )); ?>
                    </td>
                    <td><?php echo CHtml::textField('[sideExpenses]yearly', false,
                        array(
                            'rel'=>'tooltip',
                            'title'=>$tooltip 
                        )); ?>
                    </td>
                    <td><?php echo $form->error($costBenefitItem_salaries,'[sideExpenses]value'); ?></td>
                </tr>
                <tr class='red'>
                    <td><?php echo $form->labelEx($costBenefitItem_loans,'Loans'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_loans,'[loans]value', array(
                        'rel'=>'tooltip',
                        'title'=>'Loan costs. Includes service costs, interest and instalments.'
                     )); ?></td>
                    <td><?php echo CHtml::textField('[loans]yearly'); ?></td>
                    <td><?php echo $form->error($costBenefitItem_loans,'[loans]value'); ?></td>
                </tr>
                <tr class='red'>
                    <td><?php echo $form->labelEx($costBenefitItem_rents,'Rents'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_rents,'[rents]value', array(
                        'rel'=>'tooltip',
                        'title'=>'Total rents. Includes office rent and possible warehouse rents'
                     )); ?></td>
                    <td><?php echo CHtml::textField('[rents]yearly'); ?></td>
                    <td><?php echo $form->error($costBenefitItem_rents,'[rents]value'); ?></td>
                </tr>
                <tr class='red'>
                    <td><?php echo $form->labelEx($costBenefitItem_communication,'Communication'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_communication,'[communication]value', array(
                        'rel'=>'tooltip',
                        'title'=>'Company communications. Ex. phones, data connections. Does not include marketing costs.'
                     )); ?></td>
                    <td><?php echo CHtml::textField('[communication]yearly'); ?></td>
                    <td><?php echo $form->error($costBenefitItem_communication,'[communication]value'); ?></td>
                </tr>
                <tr class='red'>
                    <td><?php echo $form->labelEx($costBenefitItem_health,'Health'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_health,'[health]value', array(
                        'rel'=>'tooltip',
                        'title'=>'Mandatory or voluntary employee health plan costs.'
                     )); ?></td>
                    <td><?php echo CHtml::textField('[health]yearly'); ?></td>
                    <td><?php echo $form->error($costBenefitItem_health,'[health]value'); ?></td>
                </tr>
                <tr class='red'>
                    <td><?php echo $form->labelEx($costBenefitItem_other,'Other'); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_other,'[other]value', array(
                        'rel'=>'tooltip',
                        'title'=>'Other expenses that does not fit in any spesific field.'
                     )); ?></td>
                    <td><?php echo CHtml::textField('[other]yearly'); ?></td>
                    <td><?php echo $form->error($costBenefitItem_other,'[other]value'); ?></td>
                </tr>
                <tr class='profit'>
                    <td>Profit</td>
                    <td><?php echo CHtml::textField('[profit]monthly'); ?></td>
                    <td><?php echo CHtml::textField('[profit]yearly'); ?></td>
                </tr>
            </table>
        </div>

	<div class="row buttons">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>"Create")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->