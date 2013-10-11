<?php
    echo "<h1>".Yii::t('Company', 'BankAccounts')."</h1>";
    
    echo "<div class=grid-view>";
    
        echo "<table class='items table table-striped'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>";
                        echo Yii::t('Company', 'Company');
                    echo "</th>"; 
                    echo "<th>";
                        echo Yii::t('BankAccount', 'Type');
                    echo "</th>"; 
                    echo "<th>";
                        echo Yii::t('BankAccount', 'iban');
                    echo "</th>"; 
                    echo "<th>";
                        echo Yii::t('BankAccount', 'Saldo');
                    echo "</th>"; 
                echo "</tr>";
            echo "</thead>";

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
                        echo $bankAccount->bankAccountType->description;
                    echo "</td>"; 
                    echo "<td>";
                        echo $bankAccount->iban;
                    echo "</td>"; 
                echo "</tr>";
            }
        }
        echo "</table>";
        
    echo "</div>";
?>