<?php
// Bank accounts info
    echo "<h2>Bank Accounts</h2>";
    
    $gridDataProvider = new CArrayDataProvider($bankAccounts);

    $gridColumns = array(
        array('name'=>'iban', 'header'=>'Name'),
        array('name'=>'name', 'header'=>'Account name'),
        array('name'=>'status', 'header'=>'Status'),
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
        'template'=>"{items}",
        'columns'=>$gridColumns,
    ));
 ?>