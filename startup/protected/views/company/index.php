<?php
/* @var $this CompanyController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Create Company', 'url'=>array('create')),
	array('label'=>'Manage Company', 'url'=>array('admin')),
);
?>

<h1>Companies</h1>

<?php // Redirect to company creation
$this->redirect(array('/company/create')); 
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
