<?php

/**
 * This is the model class for table "stock_move".
 *
 * The followings are the available columns in table 'stock_move':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $origin
 * @property string $product_uos_qty
 * @property string $date_expected
 * @property integer $product_uom
 * @property string $price_unit
 * @property string $date
 * @property integer $prodlot_id
 * @property integer $move_dest_id
 * @property string $product_qty
 * @property integer $product_uos
 * @property integer $partner_id
 * @property string $name
 * @property string $note
 * @property integer $product_id
 * @property boolean $auto_validate
 * @property integer $price_currency_id
 * @property integer $location_id
 * @property integer $company_id
 * @property integer $picking_id
 * @property string $priority
 * @property string $state
 * @property integer $location_dest_id
 * @property integer $tracking_id
 * @property integer $product_packaging
 * @property integer $purchase_line_id
 * @property integer $sale_line_id
 * @property integer $production_id
 *
 * The followings are the available model relations:
 * @property MrpProduction[] $mrpProductions
 * @property ProcurementOrder[] $procurementOrders
 * @property PurchaseOrderLine[] $purchaseOrderLines
 * @property ResUsers $writeU
 * @property StockTracking $tracking
 * @property SaleOrderLine $saleLine
 * @property PurchaseOrderLine $purchaseLine
 * @property MrpProduction $production
 * @property ProductUom $productUos
 * @property ProductUom $productUom
 * @property ProductPackaging $productPackaging
 * @property ProductProduct $product
 * @property StockProductionLot $prodlot
 * @property ResCurrency $priceCurrency
 * @property StockPicking $picking
 * @property ResPartner $partner
 * @property StockMove $moveDest
 * @property StockMove[] $stockMoves
 * @property StockLocation $location
 * @property StockLocation $locationDest
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property StockInventoryMoveRel[] $stockInventoryMoveRels
 * @property StockMoveHistoryIds[] $stockMoveHistoryIds
 * @property StockMoveHistoryIds[] $stockMoveHistoryIds1
 * @property StockPartialPickingLine[] $stockPartialPickingLines
 * @property StockReturnPickingMemory[] $stockReturnPickingMemories
 * @property MrpProductionMoveIds[] $mrpProductionMoveIds
 * @property StockPartialMoveLine[] $stockPartialMoveLines
 */
class StockMove extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stock_move';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_expected, product_uom, date, product_qty, name, product_id, location_id, company_id, location_dest_id', 'required'),
			array('create_uid, write_uid, product_uom, prodlot_id, move_dest_id, product_uos, partner_id, product_id, price_currency_id, location_id, company_id, picking_id, location_dest_id, tracking_id, product_packaging, purchase_line_id, sale_line_id, production_id', 'numerical', 'integerOnly'=>true),
			array('origin', 'length', 'max'=>64),
			array('create_date, write_date, product_uos_qty, price_unit, note, auto_validate, priority, state', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, origin, product_uos_qty, date_expected, product_uom, price_unit, date, prodlot_id, move_dest_id, product_qty, product_uos, partner_id, name, note, product_id, auto_validate, price_currency_id, location_id, company_id, picking_id, priority, state, location_dest_id, tracking_id, product_packaging, purchase_line_id, sale_line_id, production_id', 'safe', 'on'=>'search'),
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
			'mrpProductions' => array(self::HAS_MANY, 'MrpProduction', 'move_prod_id'),
			'procurementOrders' => array(self::HAS_MANY, 'ProcurementOrder', 'move_id'),
			'purchaseOrderLines' => array(self::HAS_MANY, 'PurchaseOrderLine', 'move_dest_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'tracking' => array(self::BELONGS_TO, 'StockTracking', 'tracking_id'),
			'saleLine' => array(self::BELONGS_TO, 'SaleOrderLine', 'sale_line_id'),
			'purchaseLine' => array(self::BELONGS_TO, 'PurchaseOrderLine', 'purchase_line_id'),
			'production' => array(self::BELONGS_TO, 'MrpProduction', 'production_id'),
			'productUos' => array(self::BELONGS_TO, 'ProductUom', 'product_uos'),
			'productUom' => array(self::BELONGS_TO, 'ProductUom', 'product_uom'),
			'productPackaging' => array(self::BELONGS_TO, 'ProductPackaging', 'product_packaging'),
			'product' => array(self::BELONGS_TO, 'ProductProduct', 'product_id'),
			'prodlot' => array(self::BELONGS_TO, 'StockProductionLot', 'prodlot_id'),
			'priceCurrency' => array(self::BELONGS_TO, 'ResCurrency', 'price_currency_id'),
			'picking' => array(self::BELONGS_TO, 'StockPicking', 'picking_id'),
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'moveDest' => array(self::BELONGS_TO, 'StockMove', 'move_dest_id'),
			'stockMoves' => array(self::HAS_MANY, 'StockMove', 'move_dest_id'),
			'location' => array(self::BELONGS_TO, 'StockLocation', 'location_id'),
			'locationDest' => array(self::BELONGS_TO, 'StockLocation', 'location_dest_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'stockInventoryMoveRels' => array(self::HAS_MANY, 'StockInventoryMoveRel', 'move_id'),
			'stockMoveHistoryIds' => array(self::HAS_MANY, 'StockMoveHistoryIds', 'parent_id'),
			'stockMoveHistoryIds1' => array(self::HAS_MANY, 'StockMoveHistoryIds', 'child_id'),
			'stockPartialPickingLines' => array(self::HAS_MANY, 'StockPartialPickingLine', 'move_id'),
			'stockReturnPickingMemories' => array(self::HAS_MANY, 'StockReturnPickingMemory', 'move_id'),
			'mrpProductionMoveIds' => array(self::HAS_MANY, 'MrpProductionMoveIds', 'move_id'),
			'stockPartialMoveLines' => array(self::HAS_MANY, 'StockPartialMoveLine', 'move_id'),
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
			'product_uos_qty' => 'Product Uos Qty',
			'date_expected' => 'Date Expected',
			'product_uom' => 'Product Uom',
			'price_unit' => 'Price Unit',
			'date' => 'Date',
			'prodlot_id' => 'Prodlot',
			'move_dest_id' => 'Move Dest',
			'product_qty' => 'Product Qty',
			'product_uos' => 'Product Uos',
			'partner_id' => 'Partner',
			'name' => 'Name',
			'note' => 'Note',
			'product_id' => 'Product',
			'auto_validate' => 'Auto Validate',
			'price_currency_id' => 'Price Currency',
			'location_id' => 'Location',
			'company_id' => 'Company',
			'picking_id' => 'Picking',
			'priority' => 'Priority',
			'state' => 'State',
			'location_dest_id' => 'Location Dest',
			'tracking_id' => 'Tracking',
			'product_packaging' => 'Product Packaging',
			'purchase_line_id' => 'Purchase Line',
			'sale_line_id' => 'Sale Line',
			'production_id' => 'Production',
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
		$criteria->compare('product_uos_qty',$this->product_uos_qty,true);
		$criteria->compare('date_expected',$this->date_expected,true);
		$criteria->compare('product_uom',$this->product_uom);
		$criteria->compare('price_unit',$this->price_unit,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('prodlot_id',$this->prodlot_id);
		$criteria->compare('move_dest_id',$this->move_dest_id);
		$criteria->compare('product_qty',$this->product_qty,true);
		$criteria->compare('product_uos',$this->product_uos);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('auto_validate',$this->auto_validate);
		$criteria->compare('price_currency_id',$this->price_currency_id);
		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('picking_id',$this->picking_id);
		$criteria->compare('priority',$this->priority,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('location_dest_id',$this->location_dest_id);
		$criteria->compare('tracking_id',$this->tracking_id);
		$criteria->compare('product_packaging',$this->product_packaging);
		$criteria->compare('purchase_line_id',$this->purchase_line_id);
		$criteria->compare('sale_line_id',$this->sale_line_id);
		$criteria->compare('production_id',$this->production_id);

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
	 * @return StockMove the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
