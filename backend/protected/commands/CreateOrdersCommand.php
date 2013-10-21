<?php
class CreateOrdersCommand extends CConsoleCommand
{ 
    public function run(){
        echo( date('Y-m-d H:i:s').": CreateOrders run started.\n" );
        
        # 1. Check when the last run was made
        $criteria = new CDbCriteria;
        $criteria->condition='year=:year AND week=:week';
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
        
        # 4. Set automation run as done
        $transaction = Yii::app()->db->beginTransaction();
        $orderAutomation = new OrderAutomation();
        $orderAutomation->year = date('Y');
        $orderAutomation->week = date('W');
        
        if($orderAutomation->validate()){
            $headerSuccess = $orderAutomation->save();
        }
        
        # 5. Run through each firm
        foreach($suppliers as $supplier){
            echo( "Using company '{$supplier->name}'\n" );

            // Get the customer tag
            $customerTag = $supplier->tokenKey->tokenCustomer->tag;
            // Get the customer setup
            $orderSetup = isset($orderSetups[ $customerTag ]) ? $orderSetups[ $customerTag ] : $orderSetups[ 'default' ];

            // Use the latest cost-benefit calculation
            // Get the latest cost-benefit calculation
            $criteria = new CDbCriteria();
            $criteria->addCondition("company_id={$supplier->id}");
            $criteria->order = 'create_date DESC';
            $CBC = CostbenefitCalculation::model()->find( $criteria );
            
            // Get the turnover
            $criteria = new CDbCriteria;
            $criteria->condition = 'costbenefit_calculation_id=:id AND costbenefit_item_type_id=1';
            $criteria->params = array(':id'=>$CBC->id);
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
            
            $supplierOrderTotalAmount = 0;
            $supplierOrderTotalRows = 0;
            $supplierOrderTotalValue = 0;
            // Create the orders
            foreach($portions as $portion){
                // Decide the order type
                if($productOrders > 0){
                    $currentSetup = $orderSetup[ 'product' ];
                    $productOrders--;
                }
                elseif($groupOrders > 0){
                    $currentSetup = $orderSetup[ 'group' ];
                    $groupOrders--;
                }
                elseif($randomOrders > 0){
                    $currentSetup = $orderSetup[ 'random' ];
                    $randomOrders--;
                }
                
                $order = new Order();
                $eventTime = GetRandomDateTimeForWeek::run();
                echo( "Using event time '{$eventTime}'\n" );
                
                $order->event_time = $eventTime;
                $order->rows = $currentSetup->rows;
                $order->value = round($turnover * $currentSetup->weight * $portion);
                $order->company_id = $supplier->id;
                $order->order_setup_id = $currentSetup->id;
                $order->order_automation_id = $orderAutomation->id;
                
                $supplierOrderTotalAmount++;
                $supplierOrderTotalRows = $order->rows;
                $supplierOrderTotalValue += $order->value;
                
                if( $order->save() ){
                    $rowsSuccess = true;
                    echo( "Created an {$currentSetup->type} order with {$order->rows} rows and value of {$order->value}\n" );
                    continue;
                }
                else {
                    $rowsSuccess = false;
                    break;
                }
            }
            echo( "Total of {$supplierOrderTotalAmount} orders and {$supplierOrderTotalRows} rows with a total value of {$supplierOrderTotalValue}\n\n");
        }
        
        if($headerSuccess AND $rowsSuccess){
            echo( "Orders saved\n" );
            $transaction->commit();
        }
        else {
            echo( "Error. Orders not saved\n");
            $transaction->rollback();
        }

        echo( date('Y-m-d H:i:s').": CreateOrders run ended.\n\n" );
    }
}
?>