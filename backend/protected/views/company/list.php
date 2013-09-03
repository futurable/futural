<h1>List companies</h1>

<div class="well">
<?php
    $gridDataProvider = new CArrayDataProvider($suppliers);

    $gridColumns = array(
        array('name'=>'name', 'header'=>'Name'),
        array('name'=>'businessId', 'header'=>'Business ID'),
        array('name'=>'email', 'header'=>'Email'),
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'viewButtonUrl'=>null,
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
</div>