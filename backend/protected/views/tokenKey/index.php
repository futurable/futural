<?php 
    echo "<h1>".Yii::t('TokenKey', 'TokenKeys')."</h1>";

    $gridDataProvider = new CArrayDataProvider($tokenKeys);

    $gridColumns = array(
        array('name'=>'token_key', 'header'=>Yii::t('TokenKey', 'Key')),
        array('name'=>'lifetime', 'header'=>Yii::t('TokenKey', 'Lifetime')),
        array('name'=>'create_date', 'header'=>Yii::t('TokenKey', 'CreateDate')),
        array('name'=>'reclaim_date', 'header'=>Yii::t('TokenKey', 'ReclaimDate')),
        array('name'=>'expiration_date', 'header'=>Yii::t('TokenKey', 'ExpirationDate')),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'viewButtonUrl'=>'Yii::app()->createUrl("/tokenKey/view", array("id" => $data["id"]))',
            'updateButtonUrl'=>'Yii::app()->createUrl("/tokenKey/update", array("id" => $data["id"]))',
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
