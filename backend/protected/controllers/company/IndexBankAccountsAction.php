<?php
class IndexBankAccountsAction extends CAction
{
    public function run()
    {
        $controller=$this->getController();
        $controller->allowUser(MANAGER);
        
        $suppliers = Suppliers::get();
        
        $controller->render('index',array(
            'suppliers'=>$suppliers,
        ));
    }
}
?>