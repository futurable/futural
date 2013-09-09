<h1>Companies</h1>

<div class="">
<?php
    $gridDataProvider = new CArrayDataProvider($suppliers);

    $gridColumns = array(
        array('name'=>'name', 'header'=>'Name'),
        array('name'=>'business_id', 'header'=>'Business ID'),
        array('name'=>'email', 'header'=>'Email'),
        array('name'=>'create_time', 'header'=>'Create time'),
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'viewButtonUrl'=>'Yii::app()->createUrl("/company/view", array("id" => $data["id"], "action" => "info"))',
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
</div>