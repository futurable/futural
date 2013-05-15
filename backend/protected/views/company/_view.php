<?php
/* @var $this CompanyController */
/* @var $data Company */
?>

<div class="view">

 	<b><?php echo CHtml::encode($data->getAttributeLabel('customer')); ?>:</b>
	<?php echo CHtml::encode($data->tokenKey->tokenCustomer->name); ?>
	<br />
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tag')); ?>:</b>
	<?php echo CHtml::encode($data->tag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('industry_id')); ?>:</b>
	<?php echo CHtml::encode($data->industry->name); ?>
	<br />


</div>