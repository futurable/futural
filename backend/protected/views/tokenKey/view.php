<h1>View TokenKey #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'token_key',
		'lifetime',
		'create_date',
		'reclaim_date',
		'expiration_date',
		'token_customer_id',
		'token_setup_id',
	),
)); 

echo CHtml::link('Back',array('tokenKey/index'),array('class'=>'btn'));

?>


