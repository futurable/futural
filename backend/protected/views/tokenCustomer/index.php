<h1>Token Customers</h1>

<?php 

    $gridDataProvider = new CArrayDataProvider($tokenCustomers);

    $gridColumns = array(
        array('name'=>'tag', 'header'=>'Tag'),
        array('name'=>'name', 'header'=>'Name'),
        array('name'=>'street', 'header'=>'Street'),
        array('name'=>'city', 'header'=>'City'),
        array('name'=>'phone', 'header'=>'Phone'),
        array('name'=>'email', 'header'=>'Email'),
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'viewButtonUrl'=>'Yii::app()->createUrl("/tokenCustomer/view", array("id" => $data["id"]))',
            'updateButtonUrl'=>'Yii::app()->createUrl("/tokenCustomer/update", array("id" => $data["id"]))',
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
