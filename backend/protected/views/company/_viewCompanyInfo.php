<?php
    // Company info
    echo "<h2>".Yii::t('Company', 'CompanyInfo')."</h2>";
    
    $this->widget('bootstrap.widgets.TbDetailView', array(
        'data'=>$company,
        'attributes'=>array(
            array('name'=>'name'),
            array('name'=>'tag'),
            array('name'=>'business_id'),
            array('name'=>'email'),
            array('name'=>'create_time'),
            array('name'=>'employees'),
        ),
    ));
    
    $loginUrl = "http://erp.futurality.fi/?db={$company->tag}";
    echo "<p>OpenERP ".Yii::t('Company', 'login').":<br/> <a href={$loginUrl}>{$loginUrl}</a></p>";
 ?>