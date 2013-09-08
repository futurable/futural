<?php
    echo "<h2>Employees</h2>";
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
