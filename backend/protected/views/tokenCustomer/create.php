<?php
/* @var $this TokenCustomerController */
/* @var $model TokenCustomer */

$this->breadcrumbs=array(
	'Token Customers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TokenCustomer', 'url'=>array('index')),
	array('label'=>'Manage TokenCustomer', 'url'=>array('admin')),
);
?>

<h1>Create TokenCustomer</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>