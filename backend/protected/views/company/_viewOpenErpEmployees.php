<?php
   echo "<h2>".Yii::t('Company', 'Employees')."</h2>";
    
    echo "<div class='grid-view' id='HrEmployees'>";
    
        echo "<table class='items table table-striped'>";
            echo "<thead>";
                echo "<tr>";
                     echo "<th>".Yii::t('Company', 'Name')."</th>";
                     echo "<th>".Yii::t('Company', 'CreateDate')."</th>";
                     echo "<th>".Yii::t('Company', 'Email')."</th>";
                     echo "<th>".Yii::t('Company', 'PurchaseOrders')."</th>";
                     echo "<th>".Yii::t('Company', 'SaleOrders')."</th>";
                     echo "<th>".Yii::t('Company', 'BookingEntries')."</th>";
                     echo "<th>".Yii::t('Company', 'Products')."</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
                foreach($OEHrEmployees as $OEEmployee){
                    $createDate = date('d.m.Y', strtotime($OEEmployee->create_date));
                    echo "<tr>";
                         echo "<td>{$OEEmployee->name_related}</td>";
                         echo "<td>{$createDate}</td>";
                         echo "<td>{$OEEmployee->work_email}</td>";
                         echo "<td>{$OEEmployee->purchaseOrdersCreated}</td>";
                         echo "<td>{$OEEmployee->saleOrdersCreated}</td>";
                         echo "<td>{$OEEmployee->accountMoveLinesCreated}</td>";
                         echo "<td>{$OEEmployee->productsCreated}</td>";
                    echo "</tr>";
                }
            echo "</tbody>";

        echo "</table>";

    echo "</div>";
?>
