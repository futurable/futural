<div class="form" id="createRemark">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'company-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($remark); ?>

	<table>
		<tr>
            <th>
                <?php echo $form->labelEx($remark,'description'); ?>
                <?php echo $form->error($remark,'description'); ?>
            </th>
            <th>
                <?php echo $form->labelEx($remark,'significance'); ?>
                <?php echo $form->error($remark,'significance'); ?>
            </th>
        </tr>

        <tr>
            <td><?php echo $form->textField($remark,'description',array('size'=>60,'maxlength'=>1024)); ?></td>
            <td><?php echo $form->dropDownList($remark,'significance', range(-5,5), array('size'=>1)); ?></td>
            <td><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'info', 'label'=>Yii::t('Company', 'Create'))); ?></td>
        </tr>	
	</table>

<?php $this->endWidget(); ?>

</div><!-- form -->