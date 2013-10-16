<?php
    echo "<h1>".Yii::t('Company', 'Users')."</h1>";
    
    echo "<div class=grid-view>";
    
        echo "<table class='items table table-striped'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>";
                        echo Yii::t('Company', 'Company');
                    echo "</th>"; 
                    echo "<th>";
                        echo Yii::t('Company', 'Employee');
                    echo "</th>"; 
                echo "</tr>";
            echo "</thead>";

        foreach($companies as $company){
            // Switch to the right company
            Yii::app()->dbopenerp->setActive(false);
            Yii::app()->dbopenerp->connectionString = "pgsql:host=erp.futurality.fi;dbname={$company['tag']}";
            Yii::app()->dbopenerp->setActive(true);
            
            $OECompany = ResCompany::model()->find();
           
            echo "<tr>";
                echo "<td><strong>";
                    echo $OECompany->name;
                echo "</strong></td>"; 
            echo "</tr>";
            
            // Get company users
            $OEEmployees = HrEmployee::model()->findAll();
            
            foreach($OEEmployees as $OEEmployee){
                $userName = isset($OEEmployee->resource->user->partner->name) ? $OEEmployee->resource->user->partner->name : "-";   
                
                echo "<tr>";
                    echo "<td/>";
                    echo "<td>";
                        echo "{$OEEmployee->name_related} ({$userName})"; 
                    echo "</td>"; 
                echo "</tr>";
            }
        }
        echo "</table>";
        
    echo "</div>";
?>