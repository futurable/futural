<?php
    $weeks = array();
    $backTrack = 8; // Weeks
    
    while($backTrack > 0){
        $weeks[] = date('Y-W', strtotime("-$backTrack week"));
        $backTrack--;
    }
    
    echo "<h2>".Yii::t('Company', 'Timesheets')."</h2>";
    
    echo "<div class='grid-view' id='HrTimesheets'>";
    
        echo "<table class='items table table-striped verticalBorders'>";
            echo "<thead>";
                echo "<tr>";
                     echo "<th>".Yii::t('Company', 'Employee')."</th>";
                    foreach($weeks as $week){
                        echo "<th>";
                            echo substr($week, -2);
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
                $User = ResourceResource::model()->findByAttributes( array('user_id' => $key) );
                $HourSum = 0;
                
                echo "<tr>";
                    echo "<td>{$User->name}</td>";
                    foreach($weeks as $week){
                        echo "<td>";
                            if(array_key_exists($week, $UserRecords)){
                                echo $UserRecords[$week];
                                $HourSum += $UserRecords[$week];
                            }
                        echo "</td>";
                    }
                    $hours = floor($HourSum);
                    $minutes = round( ($HourSum - $hours) * 60 );
                    echo "<td>{$hours}h {$minutes}m</td>";
               echo "</tr>";
            }
            echo "</tbody>";

        echo "</table>";

    echo "</div>";
?>
