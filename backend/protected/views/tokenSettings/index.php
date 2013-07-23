<?php
/* @var $this TokenSettingsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Token Settings',
);

$this->menu=array(
	array('label'=>'Create TokenSettings', 'url'=>array('create')),
	array('label'=>'Manage TokenSettings', 'url'=>array('admin')),
);
?>

<h1>Token Settings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
