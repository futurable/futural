<?php
    echo "<h2>".Yii::t('Company', 'Employees')."</h2>";
    $gridDataProvider = new CArrayDataProvider($OEHrEmployees, array(           
        'pagination'=>array(
            'pageSize' => 20,
         ),
    ));

    $gridColumns = array(
        array('name'=>'name_related', 'header' => Yii::t('Company', 'Name')),
        array('name'=>'create_date', 'header' => Yii::t('Company', 'CreateDate')),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'viewButtonUrl'=>'Yii::app()->createUrl("/", array("id" => $data["id"]))',
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
