<?php
/* @var $this TokenKeyController */
/* @var $model TokenKey */

$this->breadcrumbs=array(
	'Token Keys'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List TokenKey', 'url'=>array('index')),
	array('label'=>'Create TokenKey', 'url'=>array('create')),
	array('label'=>'View TokenKey', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage TokenKey', 'url'=>array('admin')),
);
?>

<h1>Update TokenKey <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>