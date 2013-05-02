<?php
/* @var $this TokenCustomerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Token Customers',
);

$this->menu=array(
	array('label'=>'Create TokenCustomer', 'url'=>array('create')),
	array('label'=>'Manage TokenCustomer', 'url'=>array('admin')),
);
?>

<h1>Token Customers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
