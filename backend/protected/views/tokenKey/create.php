<?php
/* @var $this TokenKeyController */
/* @var $model TokenKey */

$this->breadcrumbs=array(
	'Token Keys'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TokenKey', 'url'=>array('index')),
	array('label'=>'Manage TokenKey', 'url'=>array('admin')),
);
?>

<h1>Create TokenKey</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>