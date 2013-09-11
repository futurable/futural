<?php
    // Company info
    echo "<h2>Cost-benefit calculation</h2>";
    
    echo "<table>";
        echo "<tr>";
            echo "<th>Expense</th>";
            echo "<th>Planned</th>";
            echo "<th>Realized</th>";
        echo "</tr>";
        
        echo getTableRow($costBenefitCalculationItems['turnover']);
        echo getTableRow($costBenefitCalculationItems['expenses']);
        echo getTableRow($costBenefitCalculationItems['salaries']);
        echo getTableRow($costBenefitCalculationItems['sideExpenses']);
        echo getTableRow($costBenefitCalculationItems['loans']);
        echo getTableRow($costBenefitCalculationItems['rents']);
        echo getTableRow($costBenefitCalculationItems['communication']);
        echo getTableRow($costBenefitCalculationItems['health']);
        echo getTableRow($costBenefitCalculationItems['otherExpenses']);
    echo "</table>";
    
    function getTableRow($CBCItem){
        $row = "
        <tr>
            <th>".ucfirst($CBCItem->costbenefitItemType->name)."</th>
            <td>{$CBCItem->value} &euro;</td>
        </tr>";
        
        return $row;
    };
 ?>