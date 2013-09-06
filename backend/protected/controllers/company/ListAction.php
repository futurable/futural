<?php
class ListAction extends CAction
{
    public function run()
    {
        $controller=$this->getController();
        $controller->allowUser(MANAGER);
        
        $suppliers = $controller->getSuppliers();
        
        $controller->render('list',array(
            'suppliers'=>$suppliers,
        ));
    }
}
?>