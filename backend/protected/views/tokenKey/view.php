<h1>View TokenKey #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'token_key',
		'lifetime',
		'create_date',
		'reclaim_date',
		'expiration_date',
	),
)); 

echo CHtml::link('Back',array('tokenKey/index'),array('class'=>'btn'));

?>


