<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */

define('STUDENT', 0);
define('INSTRUCTOR', 1);
define('MANAGER', 2);
define('ADMIN', 3);

class Controller extends CController
{  
    public $userData; // Holds an activeRecord with current user. NULL if guest

    public function init() {
        // Load the user
        if (!Yii::app()->user->isGuest)
            $this->userData = User::model()->findByPk(Yii::app()->user->id);
    }

    public function allowUser($min_level) { //-1 no login required 0..3: admin level
        $current_level = 0;
        if ($this->userData !== null)
            $current_level = $this->userData->role;
        if ($min_level > $current_level) {
            throw new CHttpException(403, 'You have no permission to view this content');
        }
    }
    
    public function getSuppliers()
    {
        // Get all suppliers
        $suppliers = Company::model()->findAll(array('order'=>'name'));
        
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
        
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
}