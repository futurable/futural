<?php
   echo "<h2>".Yii::t('Company', 'AutomatedOrders')."</h2>";
    
    echo "<div class='grid-view'>";
    
        echo "<table class='items table table-striped'>";
            echo "<thead>";
                echo "<tr>";
                     echo "<th>".Yii::t('Company', 'Company')."</th>";
                     echo "<th>".Yii::t('Order', 'EventTime')."</th>";
                     echo "<th>".Yii::t('Order', 'Value')."</th>";
                     echo "<th>".Yii::t('Order', 'Rows')."</th>";
                     echo "<th>".Yii::t('Order', 'Type')."</th>";
                     echo "<th>".Yii::t('Order', 'Sent')."</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
                foreach($automatedOrders as $automatedOrder){
                    $eventTime = date('d.m.Y H:i', strtotime($automatedOrder->event_time));
                    $sentTime = ($automatedOrder->sent != null) ? date('d.m.Y H:i', strtotime($automatedOrder->sent)) : Yii::t('Order', 'Pending');
                    
                    
                    echo "<tr>"; 
                         echo "<td>{$automatedOrder->company->name}</td>";
                         echo "<td>{$eventTime}</td>";
                         echo "<td>{$automatedOrder->value}&euro;</td>";
                         echo "<td>{$automatedOrder->rows}</td>";
                         echo "<td>".Yii::t('Order' , 'type_'.$automatedOrder->orderSetup->type)."</td>";
                         echo "<td>{$sentTime}</td>";

                    echo "</tr>";
                }
            echo "</tbody>";

        echo "</table>";

    echo "</div>";
?>
