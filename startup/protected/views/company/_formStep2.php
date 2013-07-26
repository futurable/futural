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
    $IndustryDescriptionArray[$industry->id] = Yii::t('Industry', $industry->description);
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
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/loaderScreen.js');
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'costBenefitCalculation',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
        'validateOnChange'=>true,
	),
)); ?>
    
    <div id='loaderScreen' style='display: none;'>
        <div class='shader'></div>
        <div class='loader'>
            <p>
                <?php echo Yii::t('Company', 'CreatingACompany'); ?><br/>
                <?php echo Yii::t('Company', 'GrabACupOfCoffee'); ?>
            </p>
            <p><img src='<?php echo Yii::app()->baseUrl."/css/img/loader.gif"; ?>'/></p>
            <p>
                <?php echo Yii::t('Company', 'PleaseBePatient'); ?>
            </p>
        </div>
    </div>
    
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
        <?php echo $form->dropDownList($company, 'industry_id', $this->getIndustryDropDown(),
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
            <table id='costBenefitCalculationTable'>
                <tr>
                    <th></th>
                    <th><?php echo  Yii::t('Company', 'Monthly') ?> (&euro;)</th>
                    <th><?php echo  Yii::t('Company', 'Yearly') ?> (&euro;)</th>
                    <th></th>
                </tr>

                <tr class='green'>
                    <?php $tooltip = Yii::t('Company', 'ToolTipTurnover'); ?>
                    <td><?php echo $form->labelEx($costBenefitItem_turnover, Yii::t('Company', 'Turnover')); ?></td>
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
                    <td><?php echo $form->labelEx($costBenefitItem_expenses, Yii::t('Company', 'Expenses')); ?></td>
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
                    <td><?php echo $form->labelEx($costBenefitItem_salaries, Yii::t('Company', 'Salaries')); ?></td>
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
                    <td><?php echo $form->labelEx($costBenefitItem_sideExpenses, Yii::t('Company', 'SideExpenses')); ?></td>
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
                    <?php $tooltip = Yii::t('Company', 'ToolTipLoans'); ?>
                    <td><?php echo $form->labelEx($costBenefitItem_loans, Yii::t('Company', 'Loans')); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_loans,'[loans]value', 
                        array(
                            'rel'=>'tooltip',
                            'title'=>$tooltip
                        )); ?>
                    </td>
                    <td><?php echo CHtml::textField('[loans]yearly', false,
                        array(
                            'rel'=>'tooltip',
                            'title'=>$tooltip 
                        )); ?>
                    </td>
                    <td><?php echo $form->error($costBenefitItem_loans,'[loans]value'); ?></td>
                </tr>
                
                <tr class='red'>
                    <?php $tooltip = Yii::t('Company', 'ToolTipRents'); ?>
                    <td><?php echo $form->labelEx($costBenefitItem_rents, Yii::t('Company', 'Rents')); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_rents,'[rents]value', 
                        array(
                            'rel'=>'tooltip',
                            'title'=>$tooltip
                        )); ?>
                    </td>
                    <td><?php echo CHtml::textField('[rents]yearly', false,
                        array(
                            'rel'=>'tooltip',
                            'title'=>$tooltip 
                        )); ?>
                    </td>
                    <td><?php echo $form->error($costBenefitItem_rents,'[rents]value'); ?></td>
                </tr>
                
                <tr class='red'>
                    <?php $tooltip = Yii::t('Company', 'ToolTipCommunication'); ?>
                    <td><?php echo $form->labelEx($costBenefitItem_communication, Yii::t('Company', 'Communication')); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_communication,'[communication]value', 
                        array(
                            'rel'=>'tooltip',
                            'title'=>$tooltip
                        )); ?>
                    </td>
                    <td><?php echo CHtml::textField('[communication]yearly', false,
                        array(
                            'rel'=>'tooltip',
                            'title'=>$tooltip 
                        )); ?>
                    </td>
                    <td><?php echo $form->error($costBenefitItem_communication,'[communication]value'); ?></td>
                </tr>
                
                <tr class='red'>
                    <?php $tooltip = Yii::t('Company', 'ToolTipHealth'); ?>
                    <td><?php echo $form->labelEx($costBenefitItem_health, Yii::t('Company', 'Health')); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_health,'[health]value', 
                        array(
                            'rel'=>'tooltip',
                            'title'=>$tooltip
                        )); ?>
                    </td>
                    <td><?php echo CHtml::textField('[health]yearly', false,
                        array(
                            'rel'=>'tooltip',
                            'title'=>$tooltip 
                        )); ?>
                    </td>
                    <td><?php echo $form->error($costBenefitItem_health,'[health]value'); ?></td>
                </tr>
                
                <tr class='red'>
                    <?php $tooltip = Yii::t('Company', 'ToolTipOther'); ?>
                    <td><?php echo $form->labelEx($costBenefitItem_other, Yii::t('Company', 'Other')); ?></td>
                    <td><?php echo $form->textField($costBenefitItem_other,'[other]value', 
                        array(
                            'rel'=>'tooltip',
                            'title'=>$tooltip
                        )); ?>
                    </td>
                    <td><?php echo CHtml::textField('[other]yearly', false,
                        array(
                            'rel'=>'tooltip',
                            'title'=>$tooltip 
                        )); ?>
                    </td>
                    <td><?php echo $form->error($costBenefitItem_other,'[other]value'); ?></td>
                </tr>
                
                <tr class='profit'>
                    <?php $tooltip = Yii::t('Company', 'ToolTipProfit'); ?>
                    <td><?php echo Yii::t('Company', 'Profit') ?></td>
                    <td><?php echo CHtml::textField('[profit]monthly', false,
                        array(
                            'rel'=>'tooltip',
                            'title'=>$tooltip 
                        )); ?>
                    </td>
                    <td><?php echo CHtml::textField('[profit]yearly', false,
                        array(
                            'rel'=>'tooltip',
                            'title'=>$tooltip 
                        )); ?>
                    </td>
                </tr>
            </table>
        </div>

	<div class="row buttons">
        <?php 
            $this->widget('bootstrap.widgets.TbButton', 
                array(
                    'buttonType'=>'submit', 
                    'label'=>Yii::t('Company', 'Create'), 
                    'htmlOptions'=> array(
                        'onclick'=>'send();',
                     ),
                )
            );
        ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
    
<script type="text/javascript">
    function send(){

        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("company/create"); ?>',
            'complete':function(){
                var showLoadScreen = true;
        
                $("#costBenefitCalculation div[class=errorMessage]").each(function() {
                    if($(this).text() != '' && $(this).attr('style') == ''){
                        showLoadScreen = false;
                        alert(this.id);
                        exit;
                    }
                });
        
                
                if(showLoadScreen == true){
                    $('#loaderScreen').fadeIn(500);
                }
            },
        dataType:'html'
      });

    }
</script>