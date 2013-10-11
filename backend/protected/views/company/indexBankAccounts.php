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
                echo "<td><strong>";
                    echo $bankUser->bankProfile->company;
                echo "</strong></td>"; 
            echo "</tr>";

            $netWorth = 0;
            foreach($bankUser->bankAccounts as $bankAccount){
                $accountSaldo = BankSaldo::getAccountSaldo($bankAccount->iban);
                $netWorth += $accountSaldo;
                $accountSaldo = number_format($accountSaldo, 2, '.', ' ');
                
                echo "<tr>";
                    echo "<td/>";
                    echo "<td>";
                        echo $bankAccount->bankAccountType->description;
                    echo "</td>"; 
                    echo "<td>";
                        echo $bankAccount->iban;
                    echo "</td>"; 
                    echo "<td>";
                        echo $accountSaldo." ".$bankAccount->bankCurrency->code;
                    echo "</td>"; 
                echo "</tr>";
            }
            
            echo "<tr>";
                echo "<td/>";
                echo "<td/>";
                echo "<td/>";
                echo "<td><strong>";
                    echo number_format($netWorth, 2, '.', ' ')." ".$bankAccount->bankCurrency->code; // @TODO: this code is wrong if we have multi-currency accounts
                echo "</td></strong>";
            echo "</tr>";
        }
        echo "</table>";
        
    echo "</div>";
?>