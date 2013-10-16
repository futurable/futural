<?php
    echo "<h1>".Yii::t('Company', 'Users')."</h1>";
    
    echo "<div class=grid-view>";
    
        $weeks = range(date('W', strtotime("-1 month")), date('W'));
    
        echo "<table class='items table table-striped'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>";
                        echo Yii::t('Company', 'Company');
                    echo "</th>"; 
                    echo "<th>";
                        echo Yii::t('Company', 'Employee');
                    echo "</th>"; 
                    foreach($weeks as $week){
                        echo "<th>";
                            echo $week;
                        echo "</th>";
                    } 
                echo "</tr>";
            echo "</thead>";
      
        foreach($companies as $company){
            $OECompany = $company['OECompany'];
            $OEEmployees = $company['OEEmployees'];
            
            echo "<tr>";
                echo "<td><strong>";
                    echo $OECompany->name;
                echo "</strong></td>"; 
            echo "</tr>";
            
            foreach($OEEmployees as $OEEmployee){
                $userName = isset($OEEmployee->resource->user->partner->name) ? $OEEmployee->resource->user->partner->name : "-";   
                // Get timesheets
                $criteria = new CDbCriteria();
                $criteria->select = 'date_trunc(\'week\', date) AS "week" , SUM(unit_amount) AS "hours"';
                $criteria->addCondition( "user_id={$OEEmployee->id}" );
                $criteria->addCondition( "date > now() - interval '3 months'" );
                $criteria->group = '"week"';
                $criteria->order = '"week" DESC';
                $OETimesheets = AccountAnalyticLine::model()->findAll($criteria);

                // Set the hour records to an array
                $HourRecords = array();
                foreach($OETimesheets as $OETimesheet){
                    $HourRecords[ date('W', strtotime($OETimesheet->week)) ] = $OETimesheet->hours;
                }
                
                echo "<tr>";
                    echo "<td/>";
                    echo "<td>";
                        echo "{$OEEmployee->name_related} ({$userName})";
                    echo "</td>";
                    foreach($weeks as $week){
                        echo "<td>";
                        if(array_key_exists($week, $HourRecords)) echo $HourRecords[$week];
                        echo "</td>";
                    }
                echo "</tr>";
            }
        }
        echo "</table>";
        
    echo "</div>";
?>