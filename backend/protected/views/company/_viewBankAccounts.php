<?php
// Bank accounts info
    echo "<h2>".Yii::t('Company', 'BankAccounts')."</h2>";
    
    $gridDataProvider = new CArrayDataProvider($bankAccounts);

    $gridColumns = array(
        array('name'=>'iban', 'header' => Yii::t('BankAccount', 'iban')),
        array('name'=>'name', 'header' => Yii::t('BankAccount', 'name')),
        array('name'=>'status', 'header' => Yii::t('BankAccount', 'status')),
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'viewButtonUrl'=>'Yii::app()->createUrl("/bankAccount/view", array("id" => $data["id"]))',
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
        'template'=>"{items}",
        'columns'=>$gridColumns,
    ));
 ?>