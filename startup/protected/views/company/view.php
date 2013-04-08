<?php
/* @var $this CompanyController */
/* @var $model Company */
/* @var $model Industry */
?>

<h1><?php echo $company->name; ?></h1>

<table>
    <tr>
        <th>Industry</th>
        <th>Description</th>
    </tr>
    <tr>
        <td><?php echo $industry->name; ?></td>
        <td><?php echo $industry->description; ?></td>
    </tr>
</table>