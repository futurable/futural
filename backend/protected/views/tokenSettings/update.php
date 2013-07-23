<?php
/* @var $this TokenSettingsController */
/* @var $model TokenSettings */

$this->breadcrumbs=array(
	'Token Settings'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List TokenSettings', 'url'=>array('index')),
	array('label'=>'Create TokenSettings', 'url'=>array('create')),
	array('label'=>'View TokenSettings', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage TokenSettings', 'url'=>array('admin')),
);
?>

<h1>Update TokenSettings <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>