<?php
/* @var $this TokenKeyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Token Keys',
);

$this->menu=array(
	array('label'=>'Create TokenKey', 'url'=>array('create')),
	array('label'=>'Manage TokenKey', 'url'=>array('admin')),
);
?>

<h1>Token Keys</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
