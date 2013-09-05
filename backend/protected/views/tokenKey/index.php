<h1>Token Keys</h1>

<?php 

    $gridDataProvider = new CArrayDataProvider($tokenKeys);

    $gridColumns = array(
        array('name'=>'token_key', 'header'=>'Key'),
        array('name'=>'lifetime', 'header'=>'Lifetime'),
        array('name'=>'create_date', 'header'=>'Create date'),
        array('name'=>'reclaim_date', 'header'=>'Reclaim date'),
        array('name'=>'expiration_date', 'header'=>'Expiration date'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'viewButtonUrl'=>'Yii::app()->createUrl("/tokenKey/view", array("id" => $data["id"]))',
            'updateButtonUrl'=>'Yii::app()->createUrl("/tokenKey/update", array("id" => $data["id"]))',
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
