<?php
    echo "<h1>".Yii::t('Company', 'BankAccounts')."</h1>";
    
    echo "<table>";
        echo "<tr>";
            echo "<th>";
                echo Yii::t('Company', 'Company');
            echo "</th>"; 
            echo "<th>";
                echo Yii::t('BankAccount', 'iban');
            echo "</th>"; 
            echo "<th>";
                echo Yii::t('BankAccount', 'saldo');
            echo "</th>"; 
        echo "</tr>";
    
    foreach($suppliers as $key => $supplier){
        $bankUser = $bankUsers[$key];
        
        echo "<tr>";
            echo "<td>";
                echo $bankUser->bankProfile->company;
            echo "</td>"; 
        echo "</tr>";
        
        foreach($bankUser->bankAccounts as $bankAccount){
            echo "<tr>";
                echo "<td/>";
                echo "<td>";
                    echo $bankAccount->iban;
                echo "</td>"; 
            echo "</tr>";
        }
    }
    
    echo "</table>";
?>