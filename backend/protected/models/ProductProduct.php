<?php

/**
 * This is the model class for table "product_product".
 *
 * The followings are the available columns in table 'product_product':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $ean13
 * @property integer $color
 * @property string $image
 * @property string $price_extra
 * @property string $default_code
 * @property string $name_template
 * @property boolean $active
 * @property string $variants
 * @property string $image_medium
 * @property string $image_small
 * @property integer $product_tmpl_id
 * @property string $price_margin
 * @property boolean $track_outgoing
 * @property boolean $track_incoming
 * @property string $valuation
 * @property boolean $track_production
 *
 * The followings are the available model relations:
 * @property AccountAnalyticLine[] $accountAnalyticLines
 * @property AccountMoveLine[] $accountMoveLines
 * @property HrEmployee[] $hrEmployees
 * @property HrTimesheetInvoiceCreate[] $hrTimesheetInvoiceCreates
 * @property HrTimesheetInvoiceCreateFinal[] $hrTimesheetInvoiceCreateFinals
 * @property MakeProcurement[] $makeProcurements
 * @property MrpBom[] $mrpBoms
 * @property MrpWorkcenter[] $mrpWorkcenters
 * @property MrpProduction[] $mrpProductions
 * @property ProcurementOrder[] $procurementOrders
 * @property ProductPricelistItem[] $productPricelistItems
 * @property ProductPackaging[] $productPackagings
 * @property PurchaseOrderLine[] $purchaseOrderLines
 * @property StockMove[] $stockMoves
 * @property StockInventoryLine[] $stockInventoryLines
 * @property SaleAdvancePaymentInv[] $saleAdvancePaymentInvs
 * @property SaleOrderLine[] $saleOrderLines
 * @property StockMoveConsume[] $stockMoveConsumes
 * @property StockInventoryLineSplit[] $stockInventoryLineSplits
 * @property StockMoveScrap[] $stockMoveScraps
 * @property StockChangeProductQty[] $stockChangeProductQties
 * @property StockPartialPickingLine[] $stockPartialPickingLines
 * @property StockReturnPickingMemory[] $stockReturnPickingMemories
 * @property StockWarehouseOrderpoint[] $stockWarehouseOrderpoints
 * @property StockMoveSplit[] $stockMoveSplits
 * @property AccountInvoiceLine[] $accountInvoiceLines
 * @property ResUsers $writeU
 * @property ProductTemplate $productTmpl
 * @property ResUsers $createU
 * @property MrpProductionProductLine[] $mrpProductionProductLines
 * @property StockPartialMoveLine[] $stockPartialMoveLines
 * @property StockProductionLot[] $stockProductionLots
 */
class ProductProduct extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_tmpl_id, valuation', 'required'),
			array('create_uid, write_uid, color, product_tmpl_id', 'numerical', 'integerOnly'=>true),
			array('ean13', 'length', 'max'=>13),
			array('default_code, variants', 'length', 'max'=>64),
			array('name_template', 'length', 'max'=>128),
			array('create_date, write_date, image, price_extra, active, image_medium, image_small, price_margin, track_outgoing, track_incoming, track_production', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, ean13, color, image, price_extra, default_code, name_template, active, variants, image_medium, image_small, product_tmpl_id, price_margin, track_outgoing, track_incoming, valuation, track_production', 'safe', 'on'=>'search'),
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
			'accountAnalyticLines' => array(self::HAS_MANY, 'AccountAnalyticLine', 'product_id'),
			'accountMoveLines' => array(self::HAS_MANY, 'AccountMoveLine', 'product_id'),
			'hrEmployees' => array(self::HAS_MANY, 'HrEmployee', 'product_id'),
			'hrTimesheetInvoiceCreates' => array(self::HAS_MANY, 'HrTimesheetInvoiceCreate', 'product'),
			'hrTimesheetInvoiceCreateFinals' => array(self::HAS_MANY, 'HrTimesheetInvoiceCreateFinal', 'product'),
			'makeProcurements' => array(self::HAS_MANY, 'MakeProcurement', 'product_id'),
			'mrpBoms' => array(self::HAS_MANY, 'MrpBom', 'product_id'),
			'mrpWorkcenters' => array(self::HAS_MANY, 'MrpWorkcenter', 'product_id'),
			'mrpProductions' => array(self::HAS_MANY, 'MrpProduction', 'product_id'),
			'procurementOrders' => array(self::HAS_MANY, 'ProcurementOrder', 'product_id'),
			'productPricelistItems' => array(self::HAS_MANY, 'ProductPricelistItem', 'product_id'),
			'productPackagings' => array(self::HAS_MANY, 'ProductPackaging', 'product_id'),
			'purchaseOrderLines' => array(self::HAS_MANY, 'PurchaseOrderLine', 'product_id'),
			'stockMoves' => array(self::HAS_MANY, 'StockMove', 'product_id'),
			'stockInventoryLines' => array(self::HAS_MANY, 'StockInventoryLine', 'product_id'),
			'saleAdvancePaymentInvs' => array(self::HAS_MANY, 'SaleAdvancePaymentInv', 'product_id'),
			'saleOrderLines' => array(self::HAS_MANY, 'SaleOrderLine', 'product_id'),
			'stockMoveConsumes' => array(self::HAS_MANY, 'StockMoveConsume', 'product_id'),
			'stockInventoryLineSplits' => array(self::HAS_MANY, 'StockInventoryLineSplit', 'product_id'),
			'stockMoveScraps' => array(self::HAS_MANY, 'StockMoveScrap', 'product_id'),
			'stockChangeProductQties' => array(self::HAS_MANY, 'StockChangeProductQty', 'product_id'),
			'stockPartialPickingLines' => array(self::HAS_MANY, 'StockPartialPickingLine', 'product_id'),
			'stockReturnPickingMemories' => array(self::HAS_MANY, 'StockReturnPickingMemory', 'product_id'),
			'stockWarehouseOrderpoints' => array(self::HAS_MANY, 'StockWarehouseOrderpoint', 'product_id'),
			'stockMoveSplits' => array(self::HAS_MANY, 'StockMoveSplit', 'product_id'),
			'accountInvoiceLines' => array(self::HAS_MANY, 'AccountInvoiceLine', 'product_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'productTmpl' => array(self::BELONGS_TO, 'ProductTemplate', 'product_tmpl_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'mrpProductionProductLines' => array(self::HAS_MANY, 'MrpProductionProductLine', 'product_id'),
			'stockPartialMoveLines' => array(self::HAS_MANY, 'StockPartialMoveLine', 'product_id'),
			'stockProductionLots' => array(self::HAS_MANY, 'StockProductionLot', 'product_id'),
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
			'ean13' => 'Ean13',
			'color' => 'Color',
			'image' => 'Image',
			'price_extra' => 'Price Extra',
			'default_code' => 'Default Code',
			'name_template' => 'Name Template',
			'active' => 'Active',
			'variants' => 'Variants',
			'image_medium' => 'Image Medium',
			'image_small' => 'Image Small',
			'product_tmpl_id' => 'Product Tmpl',
			'price_margin' => 'Price Margin',
			'track_outgoing' => 'Track Outgoing',
			'track_incoming' => 'Track Incoming',
			'valuation' => 'Valuation',
			'track_production' => 'Track Production',
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
		$criteria->compare('ean13',$this->ean13,true);
		$criteria->compare('color',$this->color);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('price_extra',$this->price_extra,true);
		$criteria->compare('default_code',$this->default_code,true);
		$criteria->compare('name_template',$this->name_template,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('variants',$this->variants,true);
		$criteria->compare('image_medium',$this->image_medium,true);
		$criteria->compare('image_small',$this->image_small,true);
		$criteria->compare('product_tmpl_id',$this->product_tmpl_id);
		$criteria->compare('price_margin',$this->price_margin,true);
		$criteria->compare('track_outgoing',$this->track_outgoing);
		$criteria->compare('track_incoming',$this->track_incoming);
		$criteria->compare('valuation',$this->valuation,true);
		$criteria->compare('track_production',$this->track_production);

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
	 * @return ProductProduct the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
