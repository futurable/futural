<?php
    echo "<h2>".Yii::t('Company', 'SaleOrders')."</h2>";
    
    echo "<div class='grid-view'>";
    
        echo "<table class='items table table-striped'>";
            echo "<thead>";
                echo "<tr>";
                     echo "<th>".Yii::t('Order', 'Creator')."</th>";
                     echo "<th>".Yii::t('Order', 'CreateDate')."</th>";
                     echo "<th>".Yii::t('Order', 'AmountUntaxed')."</th>";
                     echo "<th>".Yii::t('Order', 'AmountTax')."</th>";
                     echo "<th>".Yii::t('Order', 'TotalAmount')."</th>";
                     echo "<th>".Yii::t('Order', 'OrderState')."</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
                foreach($OESaleOrders as $SaleOrder){
                    $createDate = date('d.m.Y', strtotime($SaleOrder->create_date));
                    echo "<tr>";
                         echo "<td>{$SaleOrder->createU->partner->name}</td>";
                         echo "<td>{$createDate}</td>";
                         echo "<td>{$SaleOrder->amount_untaxed}&euro;</td>";
                         echo "<td>{$SaleOrder->amount_tax}</td>";
                         echo "<td>{$SaleOrder->amount_total}</td>";
                         echo "<td>{$SaleOrder->state}</td>";
                    echo "</tr>";
                }
            echo "</tbody>";

        echo "</table>";

    echo "</div>";
?>
