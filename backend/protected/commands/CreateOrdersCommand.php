<?php
class CreateOrdersCommand extends CConsoleCommand
{ 
    public function run(){
        echo( date('Y-m-d H:i:s').": CreateOrders run started.\n" );
        
        # 1. Check when the last run was made
        $criteria = new CDbCriteria;
        $criteria->condition='year=:year OR week=:week';
        $criteria->params=array(':year'=>date('Y'), ':week'=>date('W'));
        
        $latestOrder = OrderAutomation::model()->find( $criteria );
        if(!empty($latestOrder)){
            die( "Orders for this week already made. Exiting\n" );
        }
        // No automation run for this week. Continue
        
        # 2. Get all the suppliers
        $suppliers = Suppliers::getAll();
        
        # 3. Get the order setups
       $orderSetups = OrderSetup::model()->findAll();
        
        # 4. Run through each firm
        foreach($suppliers as $supplier){
            echo( "Using company '{$supplier->name}'\n" );
        }

        echo( date('Y-m-d H:i:s').": CreateOrders run ended.\n\n" );
    }
}
?>