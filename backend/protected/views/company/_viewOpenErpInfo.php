<?php
    // Open ERP info
    echo "<h2>OpenERP</h2>";
    
    echo "<h3>Employees</h3>";
    $gridDataProvider = new CArrayDataProvider($OEHrEmployees);

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
        'template'=>"{items}",
        'columns'=>$gridColumns,
    ));
 ?>