<div class="form" id="createRemark">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'company-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($remark); ?>

	<table>
		<tr>
            <th>
                <?php echo $form->label($remark,'description'); ?>
            </th>
            <th>
                <?php echo $form->label($remark,'significance'); ?>
            </th>
            <th>
                <?php echo $form->label($remark,'event_date'); ?>
            </th>
        </tr>

        <tr>
            <td><?php echo $form->textField($remark,'description',array('size'=>60,'maxlength'=>1024)); ?></td>
            <td><?php echo $form->dropDownList($remark,'significance', $remark->getSignificanceArray(), array('options'=>array('0'=>array('selected'=>true)))); ?></td>
            <td>
                <?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$remark,
                    'attribute'=>'event_date',
                    'language'=>Yii::app()->language,
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'defaultDate'=>$remark->event_date,
                    ),
                ));
                ?>
            </td>
            <td><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'info', 'label'=>Yii::t('Company', 'Create'))); ?></td>
        </tr>	
	</table>

<?php $this->endWidget(); ?>

</div><!-- form -->