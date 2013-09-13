<?php 
echo "<h1>".Yii::t('Order', 'Orders')."</h1>";

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
