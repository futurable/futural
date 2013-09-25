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
        $orderSetups = GetOrderSetupArray::run();
       
        # 4. Run through each firm
        foreach($suppliers as $supplier){
            echo( "Using company '{$supplier->name}'\n" );

            // Get the customer tag
            $customerTag = $supplier->tokenKey->tokenCustomer->tag;
            // Get the customer setup
            $orderSetup = isset($orderSetups[ $customerTag ]) ? $orderSetups[ $customerTag ] : $orderSetups[ 'default' ];

            // Use the first cost-benefit calculation
            $costBenefitCalculation = $supplier->costbenefitCalculations[0];
            // Get the turnover
            $criteria = new CDbCriteria;
            $criteria->condition = 'costbenefit_calculation_id=:id AND costbenefit_item_type_id=1';
            $criteria->params = array(':id'=>$costBenefitCalculation->id);
            $turnover = CostbenefitItem::model()->find($criteria)->value;

            // Decide how many orders will be made in week
            $orderAmount = 0;
            $productOrders = $orderSetup[ 'product' ]->amount;
            $groupOrders = $orderSetup[ 'group' ]->amount;
            $randomOrders = $orderSetup[ 'random' ]->amount;
            
            $orderAmount += $productOrders;
            $orderAmount += $groupOrders;
            $orderAmount += $randomOrders;
            
            // Divide the turnover to the orders
            $portions = GetRandomPercentagePortions::run($orderAmount);
            
            // Create the orders
            foreach($portions as $portion){
                // Decide the order type
                if($productOrders > 0){
                    $orderSetup = $orderSetup[ 'product' ];
                    $productOrders--;        
                }
                elseif($groupOrders > 0){
                    $orderSetup = $orderSetup[ 'group' ];
                    $groupOrders--;
                }
                elseif($randomOrders > 0){
                    $orderSetup = $orderSetup[ 'product' ];
                    $randomOrders--;
                }
                
                $order = new Order();
            }
        }

        echo( date('Y-m-d H:i:s').": CreateOrders run ended.\n\n" );
    }
}
?>