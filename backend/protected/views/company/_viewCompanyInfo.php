<?php
    // Company info
    echo "<h2>Company Info</h2>";
    
    $this->widget('bootstrap.widgets.TbDetailView', array(
        'data'=>$company,
        'attributes'=>array(
            array('name'=>'name', 'label'=>'Name'),
            array('name'=>'tag', 'label'=>'Tag'),
            array('name'=>'business_id', 'label'=>'Business ID'),
            array('name'=>'email', 'label'=>'Email'),
            array('name'=>'create_time', 'label'=>'Created'),
        ),
    ));
 ?>