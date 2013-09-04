<?php
    // Open ERP info
    echo "<h2>OpenERP</h2>";
    
    echo "<h3>Employees</h3>";
    $gridDataProvider = new CArrayDataProvider($OEHrEmployees, array(           
        'pagination'=>array(
            'pageSize' => 5,
         ),
    ));

    $gridColumns = array(
        array('name'=>'name_related', 'header'=>'Name'),
        array('name'=>'create_date', 'header'=>'Created'),
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'viewButtonUrl'=>'Yii::app()->createUrl("/bankAccount/view", array("id" => $data["id"]))',
            'updateButtonUrl'=>null,
            'deleteButtonUrl'=>null,
        )
    );

    $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped',
        'dataProvider'=>$gridDataProvider,
        'template'=>"{items}{pager}",
        'columns'=>$gridColumns,
    ));
    
    echo "<h3>Latest sale orders</h3>";
    
    $gridDataProvider = new CArrayDataProvider($OESaleOrders, array(           
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
            'viewButtonUrl'=>'Yii::app()->createUrl("/bankAccount/view", array("id" => $data["id"]))',
            'updateButtonUrl'=>null,
            'deleteButtonUrl'=>null,
        )
    );

    $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped',
        'dataProvider'=>$gridDataProvider,
        'template'=>"{items}{pager}",
        'columns'=>$gridColumns,
    ));
 ?>