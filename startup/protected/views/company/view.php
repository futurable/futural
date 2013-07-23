<?php
/* @var $this CompanyController */
/* @var $company    Company */
/* @var $industry   Industry */
/* @var $CBC        Cost-benefit calculation */
/* @var $CBC_items  Cost-benefit calculation items */
?>

<h1><?php echo $company->name; ?></h1>
<h2><?php echo $company->business_id; ?></h2>

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

<?php
echo "<h3>".Yii::t('Company', 'WhatIsNext')."</h3>";
echo "<p>".Yii::t('Company', 'TheLearningEnvironment').": <a href='https://futurality.fi'>futurality.fi</a></p>";
echo "<p>".Yii::t('Company', 'TheERPSystem').": <a href='http://erp.futurality.fi/?db=$company->tag'>erp.futurality.fi</a></p>";
echo "<p>".Yii::t('Company', 'TheBank').": <a href='http://futurality.fi/bank/index.php/user/login/?company=$company->tag'>futurality.fi/bank</a></p>";
?>