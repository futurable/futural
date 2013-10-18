<?php
    // Company info
    echo "<h2>".Yii::t('Company', 'CostBenefitCalculations')."</h2>";
    
    $weeks = range(date('W', strtotime("-1 month")), date('W'));
    $CBCValues = array();
    $CBCHeaders = array('turnover', 'expenses', 'salaries', 'loans', 'rents', 'communication', 'health', 'otherExpenses');
    
    $costBenefitCalculations = array_reverse($costBenefitCalculations, true);
    foreach($costBenefitCalculations as $costBenefitCalculationItems){
        echo "<h3>{$costBenefitCalculationItems['create_date']}</h3>";
               
        echo "<table class='table-striped table-condensed'>";
            echo "<tr>";
                echo "<th/>";
                echo "<th>".Yii::t('Company','Turnover')."</th>";
                echo "<th>".Yii::t('Company','Expenses')."</th>";
                echo "<th>".Yii::t('Company','SalariesAndSideExpenses')."</th>";
                echo "<th>".Yii::t('Company','Loans')."</th>";
                echo "<th>".Yii::t('Company','FacilityExpenses')."</th>";
                echo "<th>".Yii::t('Company','Communication')."</th>";
                echo "<th>".Yii::t('Company','Health')."</th>";
                echo "<th>".Yii::t('Company','OtherExpenses')."</th>";
            echo "</tr>";
            
            $plannedRows =  getPlannedRows($costBenefitCalculationItems);
            
            // Print yearly planned
            echo "<tr>";
                echo "<th>".Yii::t('Company', 'Planned')." (".Yii::t('Company', 'year').")</th>";
                foreach($CBCHeaders as $CBCHeader){
                    echo "<td>";
                        echo $plannedRows['yearly'][$costBenefitCalculationItems[$CBCHeader]->costbenefitItemType->name]."&euro;";
                    echo "</td>";
                }
            echo "</tr>";
            
            // Print weekly planned
            echo "<tr>";
                echo "<th>".Yii::t('Company', 'Planned')." (".Yii::t('Company', 'week').")</th>";
                foreach($CBCHeaders as $CBCHeader){
                    echo "<td>";
                        echo $plannedRows['monthly'][$costBenefitCalculationItems[$CBCHeader]->costbenefitItemType->name]."&euro;";
                    echo "</td>";
                }
            echo "</tr>"; 
            
            echo "<tr>";
                echo "<th>".Yii::t('Company', 'Realized')."</th>";
            echo "</tr>";
            
            foreach($weeks as $week){
                echo "<tr>";
                    echo "<td><strong>";
                        echo Yii::t('Company', 'week')." ".$week;
                    echo "</strong></td>";
                    
                if(array_key_exists($week, $realizedItemsArray)){
                    $realizedItem = $realizedItemsArray[$week];

                    echo getRealizedValue($realizedItem, array('300000'), false); // Turnover
                    echo getRealizedValue($realizedItem, array('400000')); // Expenses
                    echo getRealizedValue($realizedItem, array('500000')); // Salaries
                    echo "<td>".BankSaldo::getSalaryPaymentsSaldo('FI5697030000014473', $week)."&euro;</td>"; // Loans
                    echo getRealizedValue($realizedItem, array('701010', '701080')); // FacilityExpenses
                    echo getRealizedValue($realizedItem, array('703000')); // Communications
                    echo getRealizedValue($realizedItem, array('70000')); // Health
                    echo getRealizedValue($realizedItem, array('707010')); // Other expenses
                }
                
                echo "</tr>";
            }
            
        echo "</table>";
    }
    function getPlannedRows($CBCItems){
        $returnItems = array();
        
        foreach($CBCItems as $CBCItem){
            if(is_object($CBCItem)){
                $monthly = number_format($CBCItem->value, 2, '.', ' ');
                $yearly = number_format($CBCItem->value*12, 2, '.', ' ');

                $returnItems['yearly'][$CBCItem->costbenefitItemType->name] = $yearly;
                $returnItems['monthly'][$CBCItem->costbenefitItemType->name] = $monthly;  
            }
        }
        return $returnItems;
    }
    
    function getRealizedValue($realizedItem, $account = false, $negate = true){
        $realized = 0;
        if(is_array($account)){
            foreach($account as $value){
                $realized += isset($realizedItem[$value]) ? $realizedItem[$value] : 0;
            }
            if($negate) $realized *= -1;
        }
        
        $realized = "<td>".number_format($realized, 2, '.', ' ')."&euro;</td>";
        
        return $realized;
    };
 ?>