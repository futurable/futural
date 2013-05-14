<?php
/* @var $this OrderController */
/* @var $model Order */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Order', 'url'=>array('index')),
);
?>

<h1>Create Orders</h1>

<?php 
    foreach($runLog as $log){
        echo "<p>$log</p>";
    }
?>

<?php // echo $this->renderPartial('_form', array('model'=>$model)); ?>