<?php
class CreateOrdersCommand extends CConsoleCommand
{ 
    public function run(){
        echo( date('Y-m-d H:i:s').": CreateOrders run started.\n" );
        
        $suppliers = GetSuppliers::run();
        
        foreach($suppliers as $supplier){
            echo "$supplier->name \n";
        }
        
        echo( date('Y-m-d H:i:s').": CreateOrders run ended.\n\n" );
    }
}
?>