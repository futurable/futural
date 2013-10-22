<?php
echo "<h2>".Yii::t('Company', 'Remarks')."</h2>";

if(!empty($remarks)){
    echo "<table>";
        echo "<tr>";
            echo "<th>".Yii::t('Company', 'CreateDate')."</th>";
            echo "<th>".Yii::t('Company', 'Remark')."</th>";
            echo "<th>".Yii::t('Company', 'Significance')."</th>";
        echo "</tr>";
    foreach($remarks as $remark){
        echo "<tr>";
            echo "<td>{$remark->create_date}</td>";
            echo "<td>{$remark->description}</td>";
            echo "<td>{$remark->sigificance}</td>";
        echo "</tr>";
    }
    echo "</table>";
}
else{
    echo "<p>".Yii::t('Company','NoRemarks')."</p>";
}
?>