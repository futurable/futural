<?php
    echo "<h1>".Yii::t('Company', 'BankAccounts')."</h1>";
    
    echo "<table>";
        echo "<tr>";
            echo "<th>";
                echo Yii::t('Company', 'Name');
            echo "</th>"; 
            echo "<th>";
                echo Yii::t('BankAccount', 'iban');
            echo "</th>"; 
            echo "<th>";
                echo Yii::t('BankAccount', 'saldo');
            echo "</th>"; 
        echo "</tr>";
    
    foreach($suppliers as $supplier){
        echo "<tr>";
            echo "<td>";
            
            echo "</td>"; 
        echo "</tr>";
    }
    
    echo "</table>";
?>