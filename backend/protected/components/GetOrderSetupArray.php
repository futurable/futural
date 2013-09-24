<?php

class GetOrderSetupArray {

    public function run(){
        $orderSetups = OrderSetup::model()->findAll();
        $orderSetupArray = array();
        
        foreach($orderSetups as $orderSetup){
            $orderSetupArray[ $orderSetup->tokenCustomer->tag ][ $orderSetup->type ] = $orderSetup;
        }
        
        return $orderSetupArray;
    }
}

?>