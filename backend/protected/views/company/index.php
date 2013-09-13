<?php
    echo "<h1>".Yii::t('Company', 'Companies')."</h1>";

    $gridDataProvider = new CArrayDataProvider($suppliers);

    $gridColumns = array(
        array('name'=>'name', 'header'=>Yii::t('Company', 'Name')),
        array('name'=>'business_id', 'header'=>Yii::t('Company', 'BusinessId')),
        array('name'=>'email', 'header'=>Yii::t('Company', 'Email')),
        array('name'=>'create_time', 'header'=>Yii::t('Company', 'CreateTime')),
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