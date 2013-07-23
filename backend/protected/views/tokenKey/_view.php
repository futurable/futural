<?php
/* @var $this TokenKeyController */
/* @var $data TokenKey */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TokenKey')); ?>:</b>
	<?php echo CHtml::encode($data->TokenKey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CreateDate')); ?>:</b>
	<?php echo CHtml::encode($data->CreateDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ReclaimDate')); ?>:</b>
	<?php echo CHtml::encode($data->ReclaimDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Lifetime')); ?>:</b>
	<?php echo CHtml::encode($data->Lifetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ExpirationDate')); ?>:</b>
	<?php echo CHtml::encode($data->ExpirationDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Token_Customer_ID')); ?>:</b>
	<?php echo CHtml::encode($data->Token_Customer_ID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Token_Settings_ID')); ?>:</b>
	<?php echo CHtml::encode($data->Token_Settings_ID); ?>
	<br />

	*/ ?>

</div>