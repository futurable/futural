<?php

/**
 * This is the model class for table "stock_warehouse".
 *
 * The followings are the available columns in table 'stock_warehouse':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $lot_input_id
 * @property integer $lot_output_id
 * @property string $name
 * @property integer $lot_stock_id
 * @property integer $partner_id
 * @property integer $company_id
 *
 * The followings are the available model relations:
 * @property MakeProcurement[] $makeProcurements
 * @property PurchaseOrder[] $purchaseOrders
 * @property StockWarehouseOrderpoint[] $stockWarehouseOrderpoints
 * @property SaleShop[] $saleShops
 * @property ResUsers $writeU
 * @property ResPartner $partner
 * @property StockLocation $lotStock
 * @property StockLocation $lotOutput
 * @property StockLocation $lotInput
 * @property ResUsers $createU
 * @property ResCompany $company
 */
class StockWarehouse extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stock_warehouse';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lot_input_id, lot_output_id, name, lot_stock_id, company_id', 'required'),
			array('create_uid, write_uid, lot_input_id, lot_output_id, lot_stock_id, partner_id, company_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			array('create_date, write_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, lot_input_id, lot_output_id, name, lot_stock_id, partner_id, company_id', 'safe', 'on'=>'search'),
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
			'makeProcurements' => array(self::HAS_MANY, 'MakeProcurement', 'warehouse_id'),
			'purchaseOrders' => array(self::HAS_MANY, 'PurchaseOrder', 'warehouse_id'),
			'stockWarehouseOrderpoints' => array(self::HAS_MANY, 'StockWarehouseOrderpoint', 'warehouse_id'),
			'saleShops' => array(self::HAS_MANY, 'SaleShop', 'warehouse_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'lotStock' => array(self::BELONGS_TO, 'StockLocation', 'lot_stock_id'),
			'lotOutput' => array(self::BELONGS_TO, 'StockLocation', 'lot_output_id'),
			'lotInput' => array(self::BELONGS_TO, 'StockLocation', 'lot_input_id'),
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
			'lot_input_id' => 'Lot Input',
			'lot_output_id' => 'Lot Output',
			'name' => 'Name',
			'lot_stock_id' => 'Lot Stock',
			'partner_id' => 'Partner',
			'company_id' => 'Company',
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
		$criteria->compare('lot_input_id',$this->lot_input_id);
		$criteria->compare('lot_output_id',$this->lot_output_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('lot_stock_id',$this->lot_stock_id);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('company_id',$this->company_id);

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
	 * @return StockWarehouse the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
