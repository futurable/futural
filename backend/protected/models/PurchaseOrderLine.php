<?php

/**
 * This is the model class for table "purchase_order_line".
 *
 * The followings are the available columns in table 'purchase_order_line':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $product_uom
 * @property integer $order_id
 * @property string $price_unit
 * @property integer $move_dest_id
 * @property string $product_qty
 * @property integer $partner_id
 * @property boolean $invoiced
 * @property string $name
 * @property string $date_planned
 * @property integer $company_id
 * @property string $state
 * @property integer $product_id
 * @property integer $account_analytic_id
 *
 * The followings are the available model relations:
 * @property PurchaseOrderTaxe[] $purchaseOrderTaxes
 * @property ResUsers $writeU
 * @property ProductUom $productUom
 * @property ProductProduct $product
 * @property PurchaseOrder $order
 * @property StockMove $moveDest
 * @property ResUsers $createU
 * @property AccountAnalyticAccount $accountAnalytic
 * @property StockMove[] $stockMoves
 * @property PurchaseOrderLineInvoiceRel[] $purchaseOrderLineInvoiceRels
 */
class PurchaseOrderLine extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'purchase_order_line';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_uom, order_id, price_unit, product_qty, name, date_planned, state', 'required'),
			array('create_uid, write_uid, product_uom, order_id, move_dest_id, partner_id, company_id, product_id, account_analytic_id', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date, invoiced', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, product_uom, order_id, price_unit, move_dest_id, product_qty, partner_id, invoiced, name, date_planned, company_id, state, product_id, account_analytic_id', 'safe', 'on'=>'search'),
            array('create_date,write_date','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
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
			'purchaseOrderTaxes' => array(self::HAS_MANY, 'PurchaseOrderTaxe', 'ord_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'productUom' => array(self::BELONGS_TO, 'ProductUom', 'product_uom'),
			'product' => array(self::BELONGS_TO, 'ProductProduct', 'product_id'),
			'order' => array(self::BELONGS_TO, 'PurchaseOrder', 'order_id'),
			'moveDest' => array(self::BELONGS_TO, 'StockMove', 'move_dest_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'accountAnalytic' => array(self::BELONGS_TO, 'AccountAnalyticAccount', 'account_analytic_id'),
			'stockMoves' => array(self::HAS_MANY, 'StockMove', 'purchase_line_id'),
			'purchaseOrderLineInvoiceRels' => array(self::HAS_MANY, 'PurchaseOrderLineInvoiceRel', 'order_line_id'),
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
			'product_uom' => 'Product Uom',
			'order_id' => 'Order',
			'price_unit' => 'Price Unit',
			'move_dest_id' => 'Move Dest',
			'product_qty' => 'Product Qty',
			'partner_id' => 'Partner',
			'invoiced' => 'Invoiced',
			'name' => 'Name',
			'date_planned' => 'Date Planned',
			'company_id' => 'Company',
			'state' => 'State',
			'product_id' => 'Product',
			'account_analytic_id' => 'Account Analytic',
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
		$criteria->compare('product_uom',$this->product_uom);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('price_unit',$this->price_unit,true);
		$criteria->compare('move_dest_id',$this->move_dest_id);
		$criteria->compare('product_qty',$this->product_qty,true);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('invoiced',$this->invoiced);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('date_planned',$this->date_planned,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('account_analytic_id',$this->account_analytic_id);

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
	 * @return PurchaseOrderLine the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
