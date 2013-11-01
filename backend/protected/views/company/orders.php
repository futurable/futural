<?php
    echo "<h1>".Yii::t('Menu', 'Orders')."</h1>";
    
    $this->renderPartial('_viewAutomatedOrders', 
            array(
               'automatedOrders'=>$automatedOrders, 
            ));
?>