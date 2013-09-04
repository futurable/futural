<?php

/**
 * This is the model class for table "stock_warehouse_orderpoint".
 *
 * The followings are the available columns in table 'stock_warehouse_orderpoint':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property double $product_max_qty
 * @property double $product_min_qty
 * @property integer $qty_multiple
 * @property integer $procurement_id
 * @property string $name
 * @property integer $product_uom
 * @property integer $company_id
 * @property integer $warehouse_id
 * @property string $logic
 * @property boolean $active
 * @property integer $location_id
 * @property integer $product_id
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property StockWarehouse $warehouse
 * @property ProductUom $productUom
 * @property ProductProduct $product
 * @property ProcurementOrder $procurement
 * @property StockLocation $location
 * @property ResUsers $createU
 * @property ResCompany $company
 */
class StockWarehouseOrderpoint extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stock_warehouse_orderpoint';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_max_qty, product_min_qty, qty_multiple, name, product_uom, company_id, warehouse_id, logic, location_id, product_id', 'required'),
			array('create_uid, write_uid, qty_multiple, procurement_id, product_uom, company_id, warehouse_id, location_id, product_id', 'numerical', 'integerOnly'=>true),
			array('product_max_qty, product_min_qty', 'numerical'),
			array('name', 'length', 'max'=>32),
			array('create_date, write_date, active', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, product_max_qty, product_min_qty, qty_multiple, procurement_id, name, product_uom, company_id, warehouse_id, logic, active, location_id, product_id', 'safe', 'on'=>'search'),
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
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'warehouse' => array(self::BELONGS_TO, 'StockWarehouse', 'warehouse_id'),
			'productUom' => array(self::BELONGS_TO, 'ProductUom', 'product_uom'),
			'product' => array(self::BELONGS_TO, 'ProductProduct', 'product_id'),
			'procurement' => array(self::BELONGS_TO, 'ProcurementOrder', 'procurement_id'),
			'location' => array(self::BELONGS_TO, 'StockLocation', 'location_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
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
			'product_max_qty' => 'Product Max Qty',
			'product_min_qty' => 'Product Min Qty',
			'qty_multiple' => 'Qty Multiple',
			'procurement_id' => 'Procurement',
			'name' => 'Name',
			'product_uom' => 'Product Uom',
			'company_id' => 'Company',
			'warehouse_id' => 'Warehouse',
			'logic' => 'Logic',
			'active' => 'Active',
			'location_id' => 'Location',
			'product_id' => 'Product',
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
		$criteria->compare('product_max_qty',$this->product_max_qty);
		$criteria->compare('product_min_qty',$this->product_min_qty);
		$criteria->compare('qty_multiple',$this->qty_multiple);
		$criteria->compare('procurement_id',$this->procurement_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('product_uom',$this->product_uom);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('warehouse_id',$this->warehouse_id);
		$criteria->compare('logic',$this->logic,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('product_id',$this->product_id);

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
	 * @return StockWarehouseOrderpoint the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
