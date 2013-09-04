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
 ?>