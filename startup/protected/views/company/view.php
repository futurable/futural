<?php
/* @var $this CompanyController */
/* @var $company    Company */
/* @var $industry   Industry */
/* @var $CBC        Cost-benefit calculation */
/* @var $CBC_items  Cost-benefit calculation items */
?>

<h1><?php echo "$company->name ($company->tag)"; ?></h1>

<table>
    <tr>
        <th>Industry</th>
        <th>Description</th>
        <th>Medium turnover</th>
        <th>Minimum wage rate</th>
    </tr>
    <tr>
        <td><?php echo ucfirst($industry->name); ?></td>
        <td><?php echo $industry->description; ?></td>
        <td><?php echo $industrySetups[0]->turnover." &euro;";?></td>
        <td><?php echo $industrySetups[0]->minimum_wage_rate." &euro;";?></td>
    </tr>
</table>

<h2>Cost-benefit calculation</h2>
<table>
    <tr>
        <th>Type</th>
        <th>Monthly cost</th>
        <th>Description</th>
    </tr>
<?php
    foreach($CBC_items as $item){
        $type = $item->costbenefitItemType;
        $typeName = ucfirst($type->name);
        
        $tableRow = "
            <tr>
                <td>$typeName</td>
                <td>$item->value &euro;</td>
                <td>$type->description</td>
            </tr>";
        
        echo $tableRow;
    }
?>
</table>