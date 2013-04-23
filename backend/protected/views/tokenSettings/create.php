<?php
/* @var $this TokenSettingsController */
/* @var $model TokenSettings */

$this->breadcrumbs=array(
	'Token Settings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TokenSettings', 'url'=>array('index')),
	array('label'=>'Manage TokenSettings', 'url'=>array('admin')),
);
?>

<h1>Create TokenSettings</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>