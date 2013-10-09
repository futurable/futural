<?php
class IndexBankAccountsAction extends CAction
{
    public function run()
    {
        $controller=$this->getController();
        $controller->allowUser(MANAGER);
        
        // Get all suppliers
        $suppliers = Suppliers::get();
        
        // Get bank accounts for the suppliers
        foreach($suppliers as $key => $supplier){
            $bankUser = BankUser::model()
                    ->with('bankAccounts')
                    ->findByAttributes(array('username'=>$supplier['id']));
        }
        
        $controller->render('indexBankAccounts',array(
            'suppliers'=>$suppliers,
        ));
    }
}
?>