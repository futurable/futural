<?php
    echo "<h1>".Yii::t('Company', 'Users')."</h1>";
    
    echo "<div class=grid-view>";
    
        $weeks = range(date('W', strtotime("-2 month")), date('W'));
    
        echo "<table class='items table table-striped verticalBorders'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>";
                        echo Yii::t('Company', 'Company');
                    echo "</th>"; 
                    echo "<th>";
                        echo Yii::t('Company', 'Employee');
                    echo "</th>";
                    echo "<th>";
                        echo Yii::t('Company', 'Tag');
                    echo "</th>";
                    echo "<th colspan='".count($weeks)."'>".Yii::t('Company', 'Timesheets');
                    echo "<th>";
                        echo Yii::t('Company', 'Sum');
                    echo "</th>"; 
                echo "</tr>";
            echo "</thead>";
      
        foreach($companies as $company){
            $CoreCompany = $company['company'];
            $OECompany = $company['OECompany'];
            $OEEmployees = $company['OEEmployees'];
            
            // Change OpenERP-database
            Yii::app()->dbopenerp->setActive(false);
            Yii::app()->dbopenerp->connectionString = "pgsql:host=erp.futurality.fi;dbname={$CoreCompany['tag']}";
            Yii::app()->dbopenerp->setActive(true);
            
            echo "<tr>";
                echo "<td><strong>";
                    echo $OECompany->name;
                echo "</strong></td>";
                echo "<td/>";
                echo "<td/>";
                foreach($weeks as $week){
                    echo "<td><strong>";
                        echo $week;
                    echo "</strong></td>";
                } 
            echo "</tr>";
            
            foreach($OEEmployees as $OEEmployee){
                // Get timesheets
                $criteria = new CDbCriteria();
                $criteria->select = 'to_char(date, \'WW\') AS week , SUM(unit_amount) AS "hours"';
                $criteria->addCondition( "user_id={$OEEmployee->id}" );
                $criteria->addCondition( "date > now() - interval '3 months'" );
                $criteria->group = '"week"';
                $criteria->order = '"week" DESC';
                $OETimesheets = AccountAnalyticLine::model()->findAll($criteria);

                // Set the hour records to an array
                $HourRecords = array();
                foreach($OETimesheets as $OETimesheet){
                    $HoursFormatted = number_format($OETimesheet->hours, 2);
                    $HourRecords[ $OETimesheet->week ] = $HoursFormatted;
                }
                $HourSum = array_sum($HourRecords);
                $hours = floor($HourSum);
                $minutes = round( ($HourSum - $hours) * 60 );
                
                echo "<tr>";
                    echo "<td/>";
                    echo "<td>{$OEEmployee->name_related}</td>";
                    echo "<td>{$OEEmployee->resource->user->login}</td>";
                    foreach($weeks as $week){
                        echo "<td>";
                            if(array_key_exists($week, $HourRecords)) echo $HourRecords[$week];
                        echo "</td>";
                    }
                    echo "<td>{$hours}h {$minutes}m</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        
    echo "</div>";
?>