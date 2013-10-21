<?php

class Suppliers {

    public function get(){
        // Get customer id
        $customer_id = Yii::app()->user->getTokenCustomer()->id;
        $role = Yii::app()->user->getRole();
        
        $criteria = new CDbCriteria();
        $criteria->alias = 'company';
        $criteria->order = 'company.name';
        $criteria->addCondition('company.active = 1');
        
        // Get all suppliers
        if($role<3){         
            $criteria->addCondition('tokenKey.token_customer_id=:id');
            $criteria->params = array(':id'=>$customer_id);
            $criteria->with = array('tokenKey');
        }
        $suppliers = Company::model()->findAll($criteria);
        
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
