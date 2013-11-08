<?php
    $this->renderPartial('_indexBankAccounts',array(
        'suppliers'=>$suppliers,
        'bankUsers'=>$bankUsers,
    ));
?>