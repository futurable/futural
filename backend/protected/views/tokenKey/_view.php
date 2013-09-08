<?php
/* @var $this TokenKeyController */
/* @var $data TokenKey */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('token_key')); ?>:</b>
	<?php echo CHtml::encode($data->token_key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lifetime')); ?>:</b>
	<?php echo CHtml::encode($data->lifetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	<?php echo CHtml::encode($data->create_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reclaim_date')); ?>:</b>
	<?php echo CHtml::encode($data->reclaim_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expiration_date')); ?>:</b>
	<?php echo CHtml::encode($data->expiration_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('token_customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->token_customer_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('token_setup_id')); ?>:</b>
	<?php echo CHtml::encode($data->token_setup_id); ?>
	<br />

	*/ ?>

</div>