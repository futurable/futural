<?php
/* @var $this TokenCustomerController */
/* @var $model TokenCustomer */

$this->breadcrumbs=array(
	'Token Customers'=>array('index'),
	$model->Name=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List TokenCustomer', 'url'=>array('index')),
	array('label'=>'Create TokenCustomer', 'url'=>array('create')),
	array('label'=>'View TokenCustomer', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage TokenCustomer', 'url'=>array('admin')),
);
?>

<h1>Update TokenCustomer <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>