<?php
   echo "<h2>Purchase orders</h2>";
    
    $gridDataProvider = new CArrayDataProvider($OEPurchaseOrders, array(           
        'pagination'=>array(
            'pageSize' => 5,
         ),
    ));

    $gridColumns = array(
        array('name'=>'create_date', 'header'=>'Created'),
        array('name'=>'amount_total', 'header'=>'Order total'),
        array('name'=>'state', 'header'=>'Order state'),
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
