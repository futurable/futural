<?php
    echo "<h2>".Yii::t('Company', 'SaleOrders')."</h2>";
    
    $gridDataProvider = new CArrayDataProvider($OESaleOrders, array(           
        'pagination'=>array(
            'pageSize' => 5,
         ),
    ));

    $gridColumns = array(
        array('name'=>'create_date', 'header'=>Yii::t('Company', 'CreateDate')),
        array('name'=>'amount_total', 'header'=>Yii::t('Company', 'TotalAmount')),
        array('name'=>'state', 'header'=>Yii::t('Company', 'OrderState')),
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'viewButtonUrl'=>null,
            'buttons'=>array(
                'view'=>array('visible'=>'false',),
                'update'=>array('visible'=>'false',),
                'delete'=>array('visible'=>'false',),
            ),
        )
    );

    $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped',
        'dataProvider'=>$gridDataProvider,
        'template'=>"{items}{pager}",
        'columns'=>$gridColumns,
    ));
?>
