<?php
/* @var $this CompanyController */
/* @var $data Company */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CompanyName')); ?>:</b>
	<?php echo CHtml::encode($data->CompanyName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Industry_ID')); ?>:</b>
	<?php echo CHtml::encode($data->Industry_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Token_Key_ID')); ?>:</b>
	<?php echo CHtml::encode($data->Token_Key_ID); ?>
	<br />


</div>