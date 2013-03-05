<?php
/* @var $this TokenKeyController */
/* @var $model TokenKey */

$this->breadcrumbs=array(
	'Token Keys'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List TokenKey', 'url'=>array('index')),
	array('label'=>'Create TokenKey', 'url'=>array('create')),
	array('label'=>'Update TokenKey', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete TokenKey', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TokenKey', 'url'=>array('admin')),
);
?>

<h1>View TokenKey #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'TokenKey',
		'CreateDate',
		'ReclaimDate',
		'Lifetime',
		'ExpirationDate',
		'Token_Customer_ID',
		'Token_Settings_ID',
	),
)); ?>
