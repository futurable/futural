<?php
/* @var $this OrderController */
/* @var $data Order */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_time')); ?>:</b>
	<?php echo CHtml::encode($data->event_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('executed')); ?>:</b>
	<?php echo CHtml::encode($data->executed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rows')); ?>:</b>
	<?php echo CHtml::encode($data->rows); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('value')); ?>:</b>
	<?php echo CHtml::encode($data->value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_id')); ?>:</b>
	<?php echo CHtml::encode($data->company_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('order_setup_id')); ?>:</b>
	<?php echo CHtml::encode($data->order_setup_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_automation_id')); ?>:</b>
	<?php echo CHtml::encode($data->order_automation_id); ?>
	<br />

	*/ ?>

</div>