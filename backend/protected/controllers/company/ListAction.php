<?php
class ListAction extends CAction
{
    public function run()
    {
        $this->allowUser(MANAGER);
        $controller=$this->getController();
        
        $suppliers = $controller->getSuppliers();
        
        $controller->render('list',array(
            'suppliers'=>$suppliers,
        ));
    }
}
?>