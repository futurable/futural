<?php
    // Company info
    echo "<h2>".Yii::t('Company', 'CostBenefitCalculation')."</h2>";
    
    $week = date('W');
    
    echo "<table class='table-striped table-condensed'>";
        echo "<tr>";
            echo "<th></th>";
            echo "<th>".Yii::t('Company', 'Planned')."</th>";
            echo "<th>".Yii::t('Company', 'Realized')."</th>";
        echo "</tr>";
        
        echo getTableRow($costBenefitCalculationItems['turnover'], $realizedItems, array('300000'));
        echo getTableRow($costBenefitCalculationItems['expenses'], $realizedItems, array('400000'));
        echo getTableRow($costBenefitCalculationItems['salaries'], $realizedItems, array('500000'), 'SalariesAndSideExpenses');
        echo getTableRow($costBenefitCalculationItems['loans'], $realizedItems);
        echo getTableRow($costBenefitCalculationItems['rents'], $realizedItems, array('701010', '701080'), 'FacilityExpenses');
        echo getTableRow($costBenefitCalculationItems['communication'], $realizedItems, array('703000'));
        echo getTableRow($costBenefitCalculationItems['health'], $realizedItems, array('70000'));
        echo getTableRow($costBenefitCalculationItems['otherExpenses'], $realizedItems, array('707010'));
    echo "</table>";

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
        $planned = number_format($CBCItem->value, 2, '.', ' ');
        
        $header = !empty($label) ? $label : ucfirst($CBCItem->costbenefitItemType->name);
        
        $row = "
        <tr>
            <th>".Yii::t('Company',$header)."</th>
            <td>{$planned} &euro;</td>
            <td>{$realized} &euro;</td>
        </tr>";
        
        return $row;
    };
 ?>