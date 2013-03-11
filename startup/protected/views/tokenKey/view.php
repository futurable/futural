<?php
/* @var $this TokenKeyController */
/* @var $model TokenKey */

$this->breadcrumbs=array(
	'Token Keys'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TokenKey', 'url'=>array('index')),
	array('label'=>'Create TokenKey', 'url'=>array('create')),
	array('label'=>'Update TokenKey', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TokenKey', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TokenKey', 'url'=>array('admin')),
);
?>

<h1>View TokenKey #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'token_key',
		'lifetime',
		'create_date',
		'reclaim_date',
		'expiration_date',
		'token_customer_id',
		'company_id',
	),
)); ?>
