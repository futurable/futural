<?php
echo "<h2>".Yii::t('Company', 'Remarks')."</h2>";

// Printing remarks
if(!empty($remarks)){
    echo "<table>";
        echo "<tr>";
            echo "<th>".Yii::t('Company', 'CreateDate')."</th>";
            echo "<th>".Yii::t('Company', 'EventDate')."</th>";
            echo "<th>".Yii::t('Company', 'Remark')."</th>";
            echo "<th>".Yii::t('Company', 'Significance')."</th>";
        echo "</tr>";
    
    $sum = 0;
    foreach($remarks as $remark){
        $sum += $remark->significance;
        $remark->significance = $remark->significance >= 0 ? "+".$remark->significance : $remark->significance;
        
        echo "<tr>";
            echo "<td>{$remark->create_date}</td>";
            echo "<td>{$remark->event_date}</td>";
            echo "<td>{$remark->description}</td>";
            echo "<td>{$remark->significance}</td>";
        echo "</tr>";
    }
    $sum = $sum >= 0 ? "+".$sum : $sum;
    echo "<tr>";
        echo "<th colspan='2' />";
        echo "<th>".Yii::t('Company', 'Sum').":</th>";
        echo "<th>{$sum}</th>";
    echo "</tr>";
    
    echo "</table>";
}
else{
    echo "<p>".Yii::t('Company','NoRemarks')."</p>";
}

// Creating remarks
if(!Yii::app()->user->isGuest) $role = Yii::app()->user->getRole();
if($role >= 2){
    echo "<h3>".Yii::t('Company', 'CreateARemark')."</h3>";
        $this->renderPartial('_createRemark', array('remark'=>$newRemark));
}
?>