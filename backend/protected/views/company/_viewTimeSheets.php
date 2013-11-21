<?php
    $weeks = range(date('W', strtotime("-2 month")), date('W'));

    echo "<h2>".Yii::t('Company', 'Timesheets')."</h2>";
    
    echo "<div class='grid-view' id='HrTimesheets'>";
    
        echo "<table class='items table table-striped'>";
            echo "<thead>";
                echo "<tr>";
                     echo "<th>".Yii::t('Company', 'Employee')."</th>";
                    foreach($weeks as $week){
                        echo "<th>";
                            echo $week;
                        echo "</th>";
                    } 
                    echo "<th>";
                        echo Yii::t('Company', 'Sum');
                    echo "</th>"; 
                    echo "</tr>";
            echo "</thead>";
            
            $HourRecords = array();
            foreach($OEHrTimesheets as $Timesheet){
                // Set the hour records to an array
                $HoursFormatted = number_format($Timesheet->hours, 2);
                $HourRecords[ $Timesheet->user_id ][ $Timesheet->week ] = $HoursFormatted;
            }
            
            echo "<tbody>";
            foreach($HourRecords as $key => $HourRecord){
                $UserRecords = $HourRecords[$key];
                $User = ResUsers::model()->findByPk($key);
                $HourSum = array_sum($UserRecords);

                echo "<tr>";
                    echo "<td>{$User->login}</td>";
                    foreach($weeks as $week){
                        echo "<td>";
                            if(array_key_exists($week, $UserRecords)) echo $UserRecords[$week];
                        echo "</td>";
                    }
                    echo "<td>{$HourSum}</td>";
               echo "</tr>";
            }
            echo "</tbody>";

        echo "</table>";

    echo "</div>";
?>
