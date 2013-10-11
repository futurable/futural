<?php
class UsersAction extends CAction
{
    public function run()
    {
        $controller=$this->getController();
        $controller->allowUser(MANAGER);
        
        // Get all suppliers
        $companies = Suppliers::get();
        
        $controller->render('users',array(
            'companies'=>$companies,
        ));
    }
}
?>