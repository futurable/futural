<?php
/* @var $this OrderController */
/* @var $model Order */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Order', 'url'=>array('index')),
	array('label'=>'Manage Order', 'url'=>array('admin')),
);
?>

<h1>Create Order</h1>

<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>$supplierData,
    ));

    # TODO: something wrong with this
    /*$this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>$customerData,
    ));*/
?>

<?php // echo $this->renderPartial('_form', array('model'=>$model)); ?>