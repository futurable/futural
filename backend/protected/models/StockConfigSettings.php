<?php

/**
 * This is the model class for table "stock_config_settings".
 *
 * The followings are the available columns in table 'stock_config_settings':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property boolean $group_uom
 * @property integer $decimal_precision
 * @property boolean $group_stock_inventory_valuation
 * @property boolean $module_stock_invoice_directly
 * @property boolean $group_stock_multiple_locations
 * @property boolean $module_product_expiry
 * @property boolean $group_stock_packaging
 * @property boolean $module_stock_location
 * @property boolean $group_stock_tracking_lot
 * @property boolean $group_stock_production_lot
 * @property boolean $group_product_variant
 * @property boolean $group_uos
 * @property boolean $module_claim_from_delivery
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ResUsers $createU
 */
class StockConfigSettings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stock_config_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_uid, write_uid, decimal_precision', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date, group_uom, group_stock_inventory_valuation, module_stock_invoice_directly, group_stock_multiple_locations, module_product_expiry, group_stock_packaging, module_stock_location, group_stock_tracking_lot, group_stock_production_lot, group_product_variant, group_uos, module_claim_from_delivery', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, group_uom, decimal_precision, group_stock_inventory_valuation, module_stock_invoice_directly, group_stock_multiple_locations, module_product_expiry, group_stock_packaging, module_stock_location, group_stock_tracking_lot, group_stock_production_lot, group_product_variant, group_uos, module_claim_from_delivery', 'safe', 'on'=>'search'),
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
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
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
			'group_uom' => 'Group Uom',
			'decimal_precision' => 'Decimal Precision',
			'group_stock_inventory_valuation' => 'Group Stock Inventory Valuation',
			'module_stock_invoice_directly' => 'Module Stock Invoice Directly',
			'group_stock_multiple_locations' => 'Group Stock Multiple Locations',
			'module_product_expiry' => 'Module Product Expiry',
			'group_stock_packaging' => 'Group Stock Packaging',
			'module_stock_location' => 'Module Stock Location',
			'group_stock_tracking_lot' => 'Group Stock Tracking Lot',
			'group_stock_production_lot' => 'Group Stock Production Lot',
			'group_product_variant' => 'Group Product Variant',
			'group_uos' => 'Group Uos',
			'module_claim_from_delivery' => 'Module Claim From Delivery',
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
		$criteria->compare('group_uom',$this->group_uom);
		$criteria->compare('decimal_precision',$this->decimal_precision);
		$criteria->compare('group_stock_inventory_valuation',$this->group_stock_inventory_valuation);
		$criteria->compare('module_stock_invoice_directly',$this->module_stock_invoice_directly);
		$criteria->compare('group_stock_multiple_locations',$this->group_stock_multiple_locations);
		$criteria->compare('module_product_expiry',$this->module_product_expiry);
		$criteria->compare('group_stock_packaging',$this->group_stock_packaging);
		$criteria->compare('module_stock_location',$this->module_stock_location);
		$criteria->compare('group_stock_tracking_lot',$this->group_stock_tracking_lot);
		$criteria->compare('group_stock_production_lot',$this->group_stock_production_lot);
		$criteria->compare('group_product_variant',$this->group_product_variant);
		$criteria->compare('group_uos',$this->group_uos);
		$criteria->compare('module_claim_from_delivery',$this->module_claim_from_delivery);

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
	 * @return StockConfigSettings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
