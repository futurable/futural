<?php
   echo "<h2>".Yii::t('Company', 'Employees')."</h2>";
    
    echo "<div class='grid-view'>";
    
        echo "<table class='items table table-striped'>";
            echo "<thead>";
                echo "<tr>";
                     echo "<th>".Yii::t('Company', 'Name')."</th>";
                     echo "<th>".Yii::t('Company', 'CreateDate')."</th>";
                     echo "<th>".Yii::t('Company', 'Email')."</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
                foreach($OEHrEmployees as $OEEmployee){
                    $createDate = date('d.m.Y', strtotime($OEEmployee->create_date));
                    echo "<tr>";
                         echo "<td>{$OEEmployee->name_related}</td>";
                         echo "<td>{$createDate}</td>";
                         echo "<td>{$OEEmployee->work_email}</td>";
                    echo "</tr>";
                }
            echo "</tbody>";

        echo "</table>";

    echo "</div>";
?>
