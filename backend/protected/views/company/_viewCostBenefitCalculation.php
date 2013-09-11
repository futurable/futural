<?php
    // Company info
    echo "<h2>Cost-benefit calculation</h2>";
    
    $week = date('W');
    
    echo "<table>";
        echo "<tr>";
            echo "<th></th>";
            echo "<th>Planned</th>";
            echo "<th>Realized</th>";
        echo "</tr>";
        
        echo getTableRow($costBenefitCalculationItems['turnover'], '300000', $realizedItems);
        echo getTableRow($costBenefitCalculationItems['expenses'], '400000', $realizedItems);
        echo getTableRow($costBenefitCalculationItems['salaries'], '50000', $realizedItems);
        echo getTableRow($costBenefitCalculationItems['sideExpenses'], '50000', $realizedItems);
        echo getTableRow($costBenefitCalculationItems['loans'], null, $realizedItems);
        echo getTableRow($costBenefitCalculationItems['rents'], '701010', $realizedItems);
        echo getTableRow($costBenefitCalculationItems['communication'], '703000', $realizedItems);
        echo getTableRow($costBenefitCalculationItems['health'], '70000', $realizedItems);
        echo getTableRow($costBenefitCalculationItems['otherExpenses'], '707010', $realizedItems);
    echo "</table>";

    function getTableRow($CBCItem, $account, $realizedItems){
        $realized = isset($realizedItems[$account]) ? $realizedItems[$account] : "0.00";
        
        $row = "
        <tr>
            <th>".ucfirst($CBCItem->costbenefitItemType->name)."</th>
            <td>{$CBCItem->value} &euro;</td>
            <td>{$realized} &euro;</td>
        </tr>";
        
        return $row;
    };
 ?>