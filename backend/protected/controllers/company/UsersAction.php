<?php
class UsersAction extends CAction
{
    public function run()
    {
        $controller=$this->getController();
        $controller->allowUser(MANAGER);
        
        // Get all suppliers
        $suppliers = Suppliers::get();
        
        $controller->render('indexBankAccounts',array(
            'suppliers'=>$suppliers,
        ));
    }
}
?>