<?php
    echo "<h2>".Yii::t('Company', 'Timecards')."</h2>";
    
    echo "<div class='grid-view' id='HrTimecard'>";
    
        echo "<table class='items table table-striped'>";
            echo "<thead>";
                echo "<tr>";
                     echo "<th>".Yii::t('Company', 'Employee')."</th>";
                     echo "<th>".Yii::t('Company', 'LoginTime')."</th>";
                     echo "<th>".Yii::t('Company', 'LogoutTime')."</th>";
                     echo "<th>".Yii::t('Company', 'Duration')."</th>";
                echo "</tr>";
            echo "</thead>";  
            
            echo "<tbody>";
                foreach($OEHrTimecards as $OEHrTimecardEmployee){
                    $User = ResourceResource::model()->findByAttributes( array('user_id' => $OEHrTimecardEmployee[0]['create_uid']) );
                    
                    echo "<tr>";
                        echo "<td>{$User->name}</td>";
                        foreach($OEHrTimecardEmployee as $OEHrTimeCard){
                            $hours = floor($OEHrTimeCard['duration'] / 3600);
                            $minutes = round( ($OEHrTimeCard['duration'] / 3600 - $hours) * 60 );
                            
                            echo "<tr>";
                                echo "<td/>";
                                echo "<td>".date('d.m.Y H:i:s', strtotime($OEHrTimeCard['login_date']))."</td>";
                                echo "<td>".date('d.m.Y H:i:s', strtotime($OEHrTimeCard['logout_date']))."</td>";
                                echo "<td>{$hours}h {$minutes}m</td>";
                            echo "</tr>";
                        }
                    echo "</tr>";
                }
            echo "</tbody>";

        echo "</table>";

    echo "</div>";
?>
