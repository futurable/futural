<?php

class Suppliers {

    public function get(){
        // Get customer id
        $customer_id = Yii::app()->user->getTokenCustomer()->id;
        $role = Yii::app()->user->getRole();
        
        // Get all suppliers
        if($role<3){
            $suppliers = Yii::app()->db->createCommand()
                ->select('c.*')
                ->from('company c')
                ->join('token_key t', 'c.token_key_id=t.id')
                ->where('t.token_customer_id=:id', array(':id'=>$customer_id))
                ->order('name')
                ->queryAll();
        } else {
            $suppliers = Company::model()->findAll(array('order'=>'name'));
        }
        
        return self::trimSuppliers($suppliers);
    }
    
    public function getAll(){
        $suppliers = Company::model()->findAll(array('order'=>'name'));
        
        return self::trimSuppliers($suppliers);
    }
    
    private function trimSuppliers($suppliers){    
        // Get supplier names in SQL-compliant array
        $supplierNames = array();
        foreach($suppliers as $supplier){
            $supplierNames[] = "{$supplier['tag']}";
        }
        $suppliersString = implode($supplierNames, ",");

        // Get all suppliers that exist in OpenERP
        $openerpSuppliers = Yii::app()->dbopenerp->createCommand()
            ->select('datname')
            ->from('pg_database')
            ->where('datistemplate = false AND datname = ANY(\'{'.$suppliersString.'}\')')
            ->queryAll();
        
        // Put existing suppliers into an array
        $existingSuppliers = array();
        foreach($openerpSuppliers as $OESupplier){
            $existingSuppliers[$OESupplier['datname']] = $OESupplier['datname'];
        }

        // Drop non-existant suppliers
        foreach($suppliers as $key => $supplier){
            if(!array_key_exists($supplier['tag'], $existingSuppliers)){
                unset( $suppliers[ $key ] );
            }
        }
        
        return $suppliers;
    }
}

?>
