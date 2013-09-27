<?php

class GetProductsArray {

    public function run($debug = false){
        ini_set("memory_limit","256M");
        $products = ProductProduct::model()->with(array(
            'productTmpl'=>array(
                'condition' => 'purchase_ok = TRUE'
            )
        ))->findAll();
        
        if($debug===true){
            echo( count($products)." products found\n" );
        }
        
        $productArray=array();
        
        foreach($products as $product){
            $productArray[ $product->productTmpl->categ_id ][] = $product;
        }
        
        return $productArray;
    }
}
?>
