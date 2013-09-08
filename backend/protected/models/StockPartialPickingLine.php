<?php

/**
 * This is the model class for table "stock_partial_picking_line".
 *
 * The followings are the available columns in table 'stock_partial_picking_line':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property boolean $update_cost
 * @property integer $product_id
 * @property integer $product_uom
 * @property integer $wizard_id
 * @property integer $currency
 * @property integer $prodlot_id
 * @property double $cost
 * @property integer $location_dest_id
 * @property integer $location_id
 * @property integer $move_id
 * @property string $quantity
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property StockPartialPicking $wizard
 * @property ProductUom $productUom
 * @property ProductProduct $product
 * @property StockProductionLot $prodlot
 * @property StockMove $move
 * @property StockLocation $location
 * @property StockLocation $locationDest
 * @property ResCurrency $currency0
 * @property ResUsers $createU
 */
class StockPartialPickingLine extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stock_partial_picking_line';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, product_uom, location_dest_id, location_id, quantity', 'required'),
			array('create_uid, write_uid, product_id, product_uom, wizard_id, currency, prodlot_id, location_dest_id, location_id, move_id', 'numerical', 'integerOnly'=>true),
			array('cost', 'numerical'),
			array('create_date, write_date, update_cost', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, update_cost, product_id, product_uom, wizard_id, currency, prodlot_id, cost, location_dest_id, location_id, move_id, quantity', 'safe', 'on'=>'search'),
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
			'wizard' => array(self::BELONGS_TO, 'StockPartialPicking', 'wizard_id'),
			'productUom' => array(self::BELONGS_TO, 'ProductUom', 'product_uom'),
			'product' => array(self::BELONGS_TO, 'ProductProduct', 'product_id'),
			'prodlot' => array(self::BELONGS_TO, 'StockProductionLot', 'prodlot_id'),
			'move' => array(self::BELONGS_TO, 'StockMove', 'move_id'),
			'location' => array(self::BELONGS_TO, 'StockLocation', 'location_id'),
			'locationDest' => array(self::BELONGS_TO, 'StockLocation', 'location_dest_id'),
			'currency0' => array(self::BELONGS_TO, 'ResCurrency', 'currency'),
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
			'update_cost' => 'Update Cost',
			'product_id' => 'Product',
			'product_uom' => 'Product Uom',
			'wizard_id' => 'Wizard',
			'currency' => 'Currency',
			'prodlot_id' => 'Prodlot',
			'cost' => 'Cost',
			'location_dest_id' => 'Location Dest',
			'location_id' => 'Location',
			'move_id' => 'Move',
			'quantity' => 'Quantity',
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
		$criteria->compare('update_cost',$this->update_cost);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('product_uom',$this->product_uom);
		$criteria->compare('wizard_id',$this->wizard_id);
		$criteria->compare('currency',$this->currency);
		$criteria->compare('prodlot_id',$this->prodlot_id);
		$criteria->compare('cost',$this->cost);
		$criteria->compare('location_dest_id',$this->location_dest_id);
		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('move_id',$this->move_id);
		$criteria->compare('quantity',$this->quantity,true);

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
	 * @return StockPartialPickingLine the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
