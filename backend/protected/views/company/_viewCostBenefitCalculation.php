<?php
    // Company info
    echo "<h2>".Yii::t('Company', 'CostBenefitCalculations')."</h2>";
    
    $weeks = range(date('W', strtotime("-1 month")), date('W'));
    
    foreach($costBenefitCalculations as $costBenefitCalculationItems){
        echo "<h3>{$costBenefitCalculationItems['create_date']}</h3>";
               
        echo "<table class='table-striped table-condensed'>";
            echo "<tr>";
                echo "<th></th>";
                echo "<th>".Yii::t('Company', 'Planned')." (".Yii::t('Company', 'year').")</th>";
                echo "<th>".Yii::t('Company', 'Planned')." (".Yii::t('Company', 'week').")</th>";
                foreach($weeks as $week){
                    echo "<td><strong>";
                        echo $week;
                    echo "</strong></td>";
                }
            echo "</tr>";

            foreach($weeks as $week){
                if(array_key_exists($week, $realizedItemsArray)){
                    $realizedItems = $realizedItemsArray[$week];
                    // Add side expenses to the same column
                    $costBenefitCalculationItems['salaries']->value += $costBenefitCalculationItems['sideExpenses']->value;

                    echo getTableRow($costBenefitCalculationItems['turnover'], $realizedItems, array('300000'));
                    echo getTableRow($costBenefitCalculationItems['expenses'], $realizedItems, array('400000'));
                    echo getTableRow($costBenefitCalculationItems['salaries'], $realizedItems, array('500000'), 'SalariesAndSideExpenses');
                    echo getTableRow($costBenefitCalculationItems['loans'], $realizedItems);
                    echo getTableRow($costBenefitCalculationItems['rents'], $realizedItems, array('701010', '701080'), 'FacilityExpenses');
                    echo getTableRow($costBenefitCalculationItems['communication'], $realizedItems, array('703000'));
                    echo getTableRow($costBenefitCalculationItems['health'], $realizedItems, array('70000'));
                    echo getTableRow($costBenefitCalculationItems['otherExpenses'], $realizedItems, array('707010'));
                }
            }
        echo "</table>";
    }
    /**
     * Function for getting printed rows
     * 
     * @param array $CBCItem // Cost-benefit calculation items
     * @param array $realizedItems // Realized values
     * @param array $account // Accounts to calculate
     * @param type $label // Lavel for the row
     * @return string
     */
    function getTableRow($CBCItem, $realizedItems, $account = false, $label = false){
        $realized = 0;
        if(is_array($account)){
            foreach($account as $value){
                $realized += isset($realizedItems[$value]) ? $realizedItems[$value] : 0;
            }  
        }
        // Remove the negative operator
        if($CBCItem->costbenefitItemType->name != 'turnover') $realized *= -1;
        // Add 2 decimals
        $realized = number_format($realized, 2, '.', ' ');
        $monthly = number_format($CBCItem->value, 2, '.', ' ');
        $yearly = number_format($CBCItem->value*12, 2, '.', ' ');
        
        $header = !empty($label) ? $label : ucfirst($CBCItem->costbenefitItemType->name);
        
        $row = "
        <tr>
            <th>".Yii::t('Company',$header)."</th>
            <td>{$yearly} &euro;</td>
            <td>{$monthly} &euro;</td>
            <td>{$realized} &euro;</td>
        </tr>";
        
        return $row;
    };
 ?>