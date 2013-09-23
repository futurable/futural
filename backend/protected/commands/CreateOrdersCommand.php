<?php
class CreateOrdersCommand extends CConsoleCommand
{
    public function run($args)
    {
        echo( date('Y-m-d H:i:s').": CreateOrders run started.\n" );
        
        echo( date('Y-m-d H:i:s').": CreateOrders run ended.\n\n" );
    }
}
?>