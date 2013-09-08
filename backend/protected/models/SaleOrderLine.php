<?php

/**
 * This is the model class for table "sale_order_line".
 *
 * The followings are the available columns in table 'sale_order_line':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $product_uos_qty
 * @property integer $product_uom
 * @property integer $sequence
 * @property integer $order_id
 * @property string $price_unit
 * @property string $product_uom_qty
 * @property string $discount
 * @property integer $product_uos
 * @property string $name
 * @property integer $company_id
 * @property integer $salesman_id
 * @property string $state
 * @property integer $product_id
 * @property integer $order_partner_id
 * @property double $th_weight
 * @property boolean $invoiced
 * @property string $type
 * @property integer $address_allotment_id
 * @property integer $procurement_id
 * @property double $delay
 * @property integer $product_packaging
 *
 * The followings are the available model relations:
 * @property StockMove[] $stockMoves
 * @property SaleOrderLinePropertyRel[] $saleOrderLinePropertyRels
 * @property SaleOrderTax[] $saleOrderTaxes
 * @property SaleOrderLineInvoiceRel[] $saleOrderLineInvoiceRels
 * @property ResUsers $writeU
 * @property ProductUom $productUos
 * @property ProductUom $productUom
 * @property ProductPackaging $productPackaging
 * @property ProductProduct $product
 * @property ProcurementOrder $procurement
 * @property SaleOrder $order
 * @property ResUsers $createU
 * @property ResPartner $addressAllotment
 */
class SaleOrderLine extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sale_order_line';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_uom, order_id, price_unit, product_uom_qty, name, state, type, delay', 'required'),
			array('create_uid, write_uid, product_uom, sequence, order_id, product_uos, company_id, salesman_id, product_id, order_partner_id, address_allotment_id, procurement_id, product_packaging', 'numerical', 'integerOnly'=>true),
			array('th_weight, delay', 'numerical'),
			array('create_date, write_date, product_uos_qty, discount, invoiced', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, product_uos_qty, product_uom, sequence, order_id, price_unit, product_uom_qty, discount, product_uos, name, company_id, salesman_id, state, product_id, order_partner_id, th_weight, invoiced, type, address_allotment_id, procurement_id, delay, product_packaging', 'safe', 'on'=>'search'),
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
			'stockMoves' => array(self::HAS_MANY, 'StockMove', 'sale_line_id'),
			'saleOrderLinePropertyRels' => array(self::HAS_MANY, 'SaleOrderLinePropertyRel', 'order_id'),
			'saleOrderTaxes' => array(self::HAS_MANY, 'SaleOrderTax', 'order_line_id'),
			'saleOrderLineInvoiceRels' => array(self::HAS_MANY, 'SaleOrderLineInvoiceRel', 'order_line_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'productUos' => array(self::BELONGS_TO, 'ProductUom', 'product_uos'),
			'productUom' => array(self::BELONGS_TO, 'ProductUom', 'product_uom'),
			'productPackaging' => array(self::BELONGS_TO, 'ProductPackaging', 'product_packaging'),
			'product' => array(self::BELONGS_TO, 'ProductProduct', 'product_id'),
			'procurement' => array(self::BELONGS_TO, 'ProcurementOrder', 'procurement_id'),
			'order' => array(self::BELONGS_TO, 'SaleOrder', 'order_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'addressAllotment' => array(self::BELONGS_TO, 'ResPartner', 'address_allotment_id'),
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
			'product_uos_qty' => 'Product Uos Qty',
			'product_uom' => 'Product Uom',
			'sequence' => 'Sequence',
			'order_id' => 'Order',
			'price_unit' => 'Price Unit',
			'product_uom_qty' => 'Product Uom Qty',
			'discount' => 'Discount',
			'product_uos' => 'Product Uos',
			'name' => 'Name',
			'company_id' => 'Company',
			'salesman_id' => 'Salesman',
			'state' => 'State',
			'product_id' => 'Product',
			'order_partner_id' => 'Order Partner',
			'th_weight' => 'Th Weight',
			'invoiced' => 'Invoiced',
			'type' => 'Type',
			'address_allotment_id' => 'Address Allotment',
			'procurement_id' => 'Procurement',
			'delay' => 'Delay',
			'product_packaging' => 'Product Packaging',
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
		$criteria->compare('product_uos_qty',$this->product_uos_qty,true);
		$criteria->compare('product_uom',$this->product_uom);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('price_unit',$this->price_unit,true);
		$criteria->compare('product_uom_qty',$this->product_uom_qty,true);
		$criteria->compare('discount',$this->discount,true);
		$criteria->compare('product_uos',$this->product_uos);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('salesman_id',$this->salesman_id);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('order_partner_id',$this->order_partner_id);
		$criteria->compare('th_weight',$this->th_weight);
		$criteria->compare('invoiced',$this->invoiced);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('address_allotment_id',$this->address_allotment_id);
		$criteria->compare('procurement_id',$this->procurement_id);
		$criteria->compare('delay',$this->delay);
		$criteria->compare('product_packaging',$this->product_packaging);

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
	 * @return SaleOrderLine the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
