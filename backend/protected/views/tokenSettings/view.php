<?php
/* @var $this TokenSettingsController */
/* @var $model TokenSettings */

$this->breadcrumbs=array(
	'Token Settings'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List TokenSettings', 'url'=>array('index')),
	array('label'=>'Create TokenSettings', 'url'=>array('create')),
	array('label'=>'Update TokenSettings', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete TokenSettings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TokenSettings', 'url'=>array('admin')),
);
?>

<h1>View TokenSettings #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Description',
		'CreateInitData',
		'CreateDemoData',
		'CreatePurchasingOrders',
		'Token_Customer_ID',
	),
)); ?>
