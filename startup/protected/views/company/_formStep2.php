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
                    <th>Expense</th>
                    <th>Monthly</th>
                    <th>Yearly</th>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($company,'industry_id'); ?><td>
                </tr>
            </table>
        </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($company->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->