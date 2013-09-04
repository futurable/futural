<?php

/**
 * This is the model class for table "procurement_order".
 *
 * The followings are the available columns in table 'procurement_order':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $origin
 * @property integer $product_uom
 * @property double $product_uos_qty
 * @property string $procure_method
 * @property string $product_qty
 * @property integer $product_uos
 * @property string $message
 * @property integer $location_id
 * @property integer $move_id
 * @property string $note
 * @property string $name
 * @property string $date_planned
 * @property boolean $close_move
 * @property integer $company_id
 * @property string $date_close
 * @property string $priority
 * @property string $state
 * @property integer $product_id
 * @property integer $purchase_id
 * @property integer $production_id
 * @property integer $bom_id
 *
 * The followings are the available model relations:
 * @property ProcurementPropertyRel[] $procurementPropertyRels
 * @property ResUsers $writeU
 * @property PurchaseOrder $purchase
 * @property MrpProduction $production
 * @property ProductUom $productUos
 * @property ProductUom $productUom
 * @property ProductProduct $product
 * @property StockMove $move
 * @property StockLocation $location
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property MrpBom $bom
 * @property SaleOrderLine[] $saleOrderLines
 * @property StockWarehouseOrderpoint[] $stockWarehouseOrderpoints
 */
class ProcurementOrder extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'procurement_order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_uom, procure_method, product_qty, location_id, name, date_planned, company_id, priority, state, product_id', 'required'),
			array('create_uid, write_uid, product_uom, product_uos, location_id, move_id, company_id, product_id, purchase_id, production_id, bom_id', 'numerical', 'integerOnly'=>true),
			array('product_uos_qty', 'numerical'),
			array('origin', 'length', 'max'=>64),
			array('message', 'length', 'max'=>124),
			array('create_date, write_date, note, close_move, date_close', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, origin, product_uom, product_uos_qty, procure_method, product_qty, product_uos, message, location_id, move_id, note, name, date_planned, close_move, company_id, date_close, priority, state, product_id, purchase_id, production_id, bom_id', 'safe', 'on'=>'search'),
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
			'procurementPropertyRels' => array(self::HAS_MANY, 'ProcurementPropertyRel', 'procurement_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'purchase' => array(self::BELONGS_TO, 'PurchaseOrder', 'purchase_id'),
			'production' => array(self::BELONGS_TO, 'MrpProduction', 'production_id'),
			'productUos' => array(self::BELONGS_TO, 'ProductUom', 'product_uos'),
			'productUom' => array(self::BELONGS_TO, 'ProductUom', 'product_uom'),
			'product' => array(self::BELONGS_TO, 'ProductProduct', 'product_id'),
			'move' => array(self::BELONGS_TO, 'StockMove', 'move_id'),
			'location' => array(self::BELONGS_TO, 'StockLocation', 'location_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'bom' => array(self::BELONGS_TO, 'MrpBom', 'bom_id'),
			'saleOrderLines' => array(self::HAS_MANY, 'SaleOrderLine', 'procurement_id'),
			'stockWarehouseOrderpoints' => array(self::HAS_MANY, 'StockWarehouseOrderpoint', 'procurement_id'),
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
			'origin' => 'Origin',
			'product_uom' => 'Product Uom',
			'product_uos_qty' => 'Product Uos Qty',
			'procure_method' => 'Procure Method',
			'product_qty' => 'Product Qty',
			'product_uos' => 'Product Uos',
			'message' => 'Message',
			'location_id' => 'Location',
			'move_id' => 'Move',
			'note' => 'Note',
			'name' => 'Name',
			'date_planned' => 'Date Planned',
			'close_move' => 'Close Move',
			'company_id' => 'Company',
			'date_close' => 'Date Close',
			'priority' => 'Priority',
			'state' => 'State',
			'product_id' => 'Product',
			'purchase_id' => 'Purchase',
			'production_id' => 'Production',
			'bom_id' => 'Bom',
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
		$criteria->compare('origin',$this->origin,true);
		$criteria->compare('product_uom',$this->product_uom);
		$criteria->compare('product_uos_qty',$this->product_uos_qty);
		$criteria->compare('procure_method',$this->procure_method,true);
		$criteria->compare('product_qty',$this->product_qty,true);
		$criteria->compare('product_uos',$this->product_uos);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('move_id',$this->move_id);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('date_planned',$this->date_planned,true);
		$criteria->compare('close_move',$this->close_move);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('date_close',$this->date_close,true);
		$criteria->compare('priority',$this->priority,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('purchase_id',$this->purchase_id);
		$criteria->compare('production_id',$this->production_id);
		$criteria->compare('bom_id',$this->bom_id);

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
	 * @return ProcurementOrder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
