<?php
   echo "<h2>".Yii::t('Company', 'PurchaseOrders')."</h2>";
    
    $gridDataProvider = new CArrayDataProvider($OEPurchaseOrders, array(           
        'pagination'=>array(
            'pageSize' => 5,
         ),
    ));

    $gridColumns = array(
        array('name'=>'create_date'),
        array('name'=>'amount_total'),
        array('name'=>'state'),
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'viewButtonUrl'=>null,
            'buttons'=>array(
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
