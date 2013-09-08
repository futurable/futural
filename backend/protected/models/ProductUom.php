<?php

/**
 * This is the model class for table "product_uom".
 *
 * The followings are the available columns in table 'product_uom':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $uom_type
 * @property integer $category_id
 * @property string $name
 * @property string $rounding
 * @property string $factor
 * @property boolean $active
 *
 * The followings are the available model relations:
 * @property AccountAnalyticLine[] $accountAnalyticLines
 * @property AccountMoveLine[] $accountMoveLines
 * @property ProductTemplate[] $productTemplates
 * @property ProductTemplate[] $productTemplates1
 * @property ProductTemplate[] $productTemplates2
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property ProductUomCateg $category
 * @property MakeProcurement[] $makeProcurements
 * @property MrpBom[] $mrpBoms
 * @property MrpBom[] $mrpBoms1
 * @property MrpProduction[] $mrpProductions
 * @property MrpProduction[] $mrpProductions1
 * @property ProcurementOrder[] $procurementOrders
 * @property ProcurementOrder[] $procurementOrders1
 * @property ProjectConfigSettings[] $projectConfigSettings
 * @property PurchaseOrderLine[] $purchaseOrderLines
 * @property StockMove[] $stockMoves
 * @property StockMove[] $stockMoves1
 * @property StockInventoryLine[] $stockInventoryLines
 * @property SaleConfigSettings[] $saleConfigSettings
 * @property SaleOrderLine[] $saleOrderLines
 * @property SaleOrderLine[] $saleOrderLines1
 * @property StockMoveConsume[] $stockMoveConsumes
 * @property StockInventoryLineSplit[] $stockInventoryLineSplits
 * @property StockMoveScrap[] $stockMoveScraps
 * @property StockPartialPickingLine[] $stockPartialPickingLines
 * @property StockWarehouseOrderpoint[] $stockWarehouseOrderpoints
 * @property StockMoveSplit[] $stockMoveSplits
 * @property AccountInvoiceLine[] $accountInvoiceLines
 * @property ResCompany[] $resCompanies
 * @property MrpProductionProductLine[] $mrpProductionProductLines
 * @property MrpProductionProductLine[] $mrpProductionProductLines1
 * @property StockPartialMoveLine[] $stockPartialMoveLines
 */
class ProductUom extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_uom';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uom_type, category_id, name, rounding, factor', 'required'),
			array('create_uid, write_uid, category_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, active', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, uom_type, category_id, name, rounding, factor, active', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'accountAnalyticLines' => array(self::HAS_MANY, 'AccountAnalyticLine', 'product_uom_id'),
			'accountMoveLines' => array(self::HAS_MANY, 'AccountMoveLine', 'product_uom_id'),
			'productTemplates' => array(self::HAS_MANY, 'ProductTemplate', 'uos_id'),
			'productTemplates1' => array(self::HAS_MANY, 'ProductTemplate', 'uom_po_id'),
			'productTemplates2' => array(self::HAS_MANY, 'ProductTemplate', 'uom_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'category' => array(self::BELONGS_TO, 'ProductUomCateg', 'category_id'),
			'makeProcurements' => array(self::HAS_MANY, 'MakeProcurement', 'uom_id'),
			'mrpBoms' => array(self::HAS_MANY, 'MrpBom', 'product_uos'),
			'mrpBoms1' => array(self::HAS_MANY, 'MrpBom', 'product_uom'),
			'mrpProductions' => array(self::HAS_MANY, 'MrpProduction', 'product_uos'),
			'mrpProductions1' => array(self::HAS_MANY, 'MrpProduction', 'product_uom'),
			'procurementOrders' => array(self::HAS_MANY, 'ProcurementOrder', 'product_uos'),
			'procurementOrders1' => array(self::HAS_MANY, 'ProcurementOrder', 'product_uom'),
			'projectConfigSettings' => array(self::HAS_MANY, 'ProjectConfigSettings', 'time_unit'),
			'purchaseOrderLines' => array(self::HAS_MANY, 'PurchaseOrderLine', 'product_uom'),
			'stockMoves' => array(self::HAS_MANY, 'StockMove', 'product_uos'),
			'stockMoves1' => array(self::HAS_MANY, 'StockMove', 'product_uom'),
			'stockInventoryLines' => array(self::HAS_MANY, 'StockInventoryLine', 'product_uom'),
			'saleConfigSettings' => array(self::HAS_MANY, 'SaleConfigSettings', 'time_unit'),
			'saleOrderLines' => array(self::HAS_MANY, 'SaleOrderLine', 'product_uos'),
			'saleOrderLines1' => array(self::HAS_MANY, 'SaleOrderLine', 'product_uom'),
			'stockMoveConsumes' => array(self::HAS_MANY, 'StockMoveConsume', 'product_uom'),
			'stockInventoryLineSplits' => array(self::HAS_MANY, 'StockInventoryLineSplit', 'product_uom'),
			'stockMoveScraps' => array(self::HAS_MANY, 'StockMoveScrap', 'product_uom'),
			'stockPartialPickingLines' => array(self::HAS_MANY, 'StockPartialPickingLine', 'product_uom'),
			'stockWarehouseOrderpoints' => array(self::HAS_MANY, 'StockWarehouseOrderpoint', 'product_uom'),
			'stockMoveSplits' => array(self::HAS_MANY, 'StockMoveSplit', 'product_uom'),
			'accountInvoiceLines' => array(self::HAS_MANY, 'AccountInvoiceLine', 'uos_id'),
			'resCompanies' => array(self::HAS_MANY, 'ResCompany', 'project_time_mode_id'),
			'mrpProductionProductLines' => array(self::HAS_MANY, 'MrpProductionProductLine', 'product_uos'),
			'mrpProductionProductLines1' => array(self::HAS_MANY, 'MrpProductionProductLine', 'product_uom'),
			'stockPartialMoveLines' => array(self::HAS_MANY, 'StockPartialMoveLine', 'product_uom'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'uom_type' => 'Uom Type',
			'category_id' => 'Category',
			'name' => 'Name',
			'rounding' => 'Rounding',
			'factor' => 'Factor',
			'active' => 'Active',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('uom_type',$this->uom_type,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('rounding',$this->rounding,true);
		$criteria->compare('factor',$this->factor,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->dbopenerp;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductUom the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
