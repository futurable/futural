<?php
   echo "<h2>".Yii::t('Company', 'PurchaseOrders')."</h2>";
    
   echo "<table class='table-striped table-condensed'>";
   echo "<tr>";
        echo "<th>".Yii::t('Order', 'Creator')."</th>";
        echo "<th>".Yii::t('Order', 'CreateDate')."</th>";
        echo "<th>".Yii::t('Order', 'AmountUntaxed')."</th>";
        echo "<th>".Yii::t('Order', 'AmountTax')."</th>";
        echo "<th>".Yii::t('Order', 'TotalAmount')."</th>";
        echo "<th>".Yii::t('Order', 'OrderState')."</th>";
   echo "</tr>";
   foreach($OEPurchaseOrders as $PurchaseOrder){
       $createDate = date('d.m.Y', strtotime($PurchaseOrder->create_date));
       
       echo "<tr>";
            echo "<td>{$PurchaseOrder->createU->partner->name}</td>";
            echo "<td>{$createDate}</td>";
            echo "<td>{$PurchaseOrder->amount_untaxed}&euro;</td>";
            echo "<td>{$PurchaseOrder->amount_tax}</td>";
            echo "<td>{$PurchaseOrder->amount_total}</td>";
            echo "<td>{$PurchaseOrder->state}</td>";
       echo "</tr>";
   }
   echo "</table>";
?>
