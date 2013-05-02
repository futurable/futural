<?php
/* @var $this TokenCustomerController */
/* @var $model TokenCustomer */

$this->breadcrumbs=array(
	'Token Customers'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TokenCustomer', 'url'=>array('index')),
	array('label'=>'Create TokenCustomer', 'url'=>array('create')),
	array('label'=>'View TokenCustomer', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TokenCustomer', 'url'=>array('admin')),
);
?>

<h1>Update TokenCustomer <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>