<?php
/* @var $this TokenSettingsController */
/* @var $data TokenSettings */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CreateInitData')); ?>:</b>
	<?php echo CHtml::encode($data->CreateInitData); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CreateDemoData')); ?>:</b>
	<?php echo CHtml::encode($data->CreateDemoData); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CreatePurchasingOrders')); ?>:</b>
	<?php echo CHtml::encode($data->CreatePurchasingOrders); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Token_Customer_ID')); ?>:</b>
	<?php echo CHtml::encode($data->Token_Customer_ID); ?>
	<br />


</div>