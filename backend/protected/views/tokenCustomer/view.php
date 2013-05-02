<?php
/* @var $this TokenCustomerController */
/* @var $model TokenCustomer */

$this->breadcrumbs=array(
	'Token Customers'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List TokenCustomer', 'url'=>array('index')),
	array('label'=>'Create TokenCustomer', 'url'=>array('create')),
	array('label'=>'Update TokenCustomer', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TokenCustomer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TokenCustomer', 'url'=>array('admin')),
);
?>

<h1>View TokenCustomer #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tag',
		'name',
		'street',
		'city',
		'phone',
		'email',
	),
)); ?>
