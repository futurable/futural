<?php
class OrdersAction extends CAction
{
    public function run()
    {
        $controller=$this->getController();
        $controller->allowUser(MANAGER);
        
        $suppliers = Suppliers::get();
        
        $controller->render('orders',array(
            'suppliers'=>$suppliers,
        ));
    }
}
?>