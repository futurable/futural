<?php
class IndexAction extends CAction
{
    public function run()
    {
        $controller=$this->getController();
        $controller->allowUser(MANAGER);
        
        $suppliers = $controller->getSuppliers();
        
        $controller->render('index',array(
            'suppliers'=>$suppliers,
        ));
    }
}
?>