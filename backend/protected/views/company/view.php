<?php 
    // Company info
    echo "<h1>{$company->name}</h1>";
    
    $this->widget('bootstrap.widgets.TbDetailView', array(
        'data'=>$company,
        'attributes'=>array(
            array('name'=>'tag', 'label'=>'Tag'),
            array('name'=>'business_id', 'label'=>'Business ID'),
            array('name'=>'email', 'label'=>'Email'),
            array('name'=>'create_time', 'label'=>'Created'),
        ),
    ));
    
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