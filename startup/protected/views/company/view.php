<?php
/* @var $this CompanyController */
/* @var $company    Company */
/* @var $industry   Industry */
/* @var $CBC        Cost-benefit calculation */
/* @var $CBC_items  Cost-benefit calculation items */
?>

<h1><?php echo "$company->name <br/> $company->business_id"; ?></h1>

<table>
    <tr>
        <th><?php echo Yii::t('Company', 'Industry'); ?></th>
        <th><?php echo Yii::t('Company', 'Description'); ?></th>
    </tr>
    <tr>
        <td><?php echo Yii::t('Industry', $industry->name); ?></td>
        <td><?php echo Yii::t('Industry', $industry->description); ?></td>
    </tr>
</table>

<h2><?php Yii::t('Company', 'CostBenefitCalculation'); ?></h2>
<table>
<?php
    foreach($CBC_items as $item){
        $type = $item->costbenefitItemType;
        $typeName = ucfirst($type->name);
        
        $tableRow = "
            <tr>
                <td>".Yii::t('Company', $typeName)."</td>
                <td>$item->value &euro;</td>
            </tr>";
        
        echo $tableRow;
    }
?>
</table>
