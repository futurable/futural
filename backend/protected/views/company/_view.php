<?php
/* @var $this CompanyController */
/* @var $data Company */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tag')); ?>:</b>
	<?php echo CHtml::encode($data->tag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('token_key_id')); ?>:</b>
	<?php echo CHtml::encode($data->token_key_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('industry_id')); ?>:</b>
	<?php echo CHtml::encode($data->industry_id); ?>
	<br />


</div>