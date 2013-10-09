<?php
class IndexBankAccountsAction extends CAction
{
    public function run()
    {
        $controller=$this->getController();
        $controller->allowUser(MANAGER);
        
        // Get 'checking account'-type bank accounts 
        $bankAccounts = BankAccount::model()->findAll(array('condition'=>'bank_account_type_id = 1 AND status="enabled"'));
        
        $controller->render('indexBankAccounts',array(
            'bankAccounts'=>$bankAccounts,
        ));
    }
}
?>