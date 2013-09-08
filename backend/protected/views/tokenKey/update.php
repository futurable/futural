<?php
/* @var $this TokenKeyController */
/* @var $model TokenKey */

$this->breadcrumbs=array(
	'Token Keys'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TokenKey', 'url'=>array('index')),
	array('label'=>'Create TokenKey', 'url'=>array('create')),
	array('label'=>'View TokenKey', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TokenKey', 'url'=>array('admin')),
);
?>

<h1>Update TokenKey <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>