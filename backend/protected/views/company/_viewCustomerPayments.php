<?php
    echo "<h2>".Yii::t('Company', 'CustomerPayments')."</h2>";
    
    echo "<div class='grid-view'>";
    
        echo "<table class='items table table-striped'>";
            echo "<thead>";
                echo "<tr>";
                     echo "<th>".Yii::t('BankAccount', 'EventDate')."</th>";
                     echo "<th>".Yii::t('BankAccount', 'Amount')."</th>";
                     echo "<th>".Yii::t('BankAccount', 'Message')."</th>";
                echo "</tr>";
            echo "</thead>";
            
            echo "<tbody>";
                foreach($CustomerPayments as $CustomerPayment){
                    $eventDate = date('d.m.Y', strtotime($CustomerPayment->event_date));
                    echo "<tr>";
                         echo "<td>{$eventDate}</td>";
                         echo "<td>{$CustomerPayment->amount} {$CustomerPayment->currency}</td>";
                         echo "<td>{$CustomerPayment->message}</td>";
                    echo "</tr>";
                }
            echo "</tbody>";

        echo "</table>";

    echo "</div>";
 ?>