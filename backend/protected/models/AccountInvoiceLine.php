<?php

/**
 * This is the model class for table "account_invoice_line".
 *
 * The followings are the available columns in table 'account_invoice_line':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $origin
 * @property integer $uos_id
 * @property integer $account_id
 * @property string $name
 * @property integer $sequence
 * @property integer $invoice_id
 * @property string $price_unit
 * @property string $price_subtotal
 * @property integer $company_id
 * @property string $discount
 * @property integer $account_analytic_id
 * @property string $quantity
 * @property integer $partner_id
 * @property integer $product_id
 *
 * The followings are the available model relations:
 * @property PurchaseOrderLineInvoiceRel[] $purchaseOrderLineInvoiceRels
 * @property SaleOrderLineInvoiceRel[] $saleOrderLineInvoiceRels
 * @property ResUsers $writeU
 * @property ProductUom $uos
 * @property ProductProduct $product
 * @property AccountInvoice $invoice
 * @property ResUsers $createU
 * @property AccountAccount $account
 * @property AccountAnalyticAccount $accountAnalytic
 * @property AccountInvoiceLineTax[] $accountInvoiceLineTaxes
 */
class AccountInvoiceLine extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_invoice_line';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_id, name, price_unit, quantity', 'required'),
			array('create_uid, write_uid, uos_id, account_id, sequence, invoice_id, company_id, account_analytic_id, partner_id, product_id', 'numerical', 'integerOnly'=>true),
			array('origin', 'length', 'max'=>256),
			array('create_date, write_date, price_subtotal, discount', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, origin, uos_id, account_id, name, sequence, invoice_id, price_unit, price_subtotal, company_id, discount, account_analytic_id, quantity, partner_id, product_id', 'safe', 'on'=>'search'),
            array('create_date,write_date','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
            array('create_uid,write_uid','default', 'value'=>'1', 'setOnEmpty'=>false,'on'=>'insert'),
            array('create_uid,write_uid,uos_id','default', 'value'=>'1', 'setOnEmpty'=>false,'on'=>'insert'),
            array('account_id','default', 'value'=>'23', 'setOnEmpty'=>false,'on'=>'insert'),
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
			'purchaseOrderLineInvoiceRels' => array(self::HAS_MANY, 'PurchaseOrderLineInvoiceRel', 'invoice_id'),
			'saleOrderLineInvoiceRels' => array(self::HAS_MANY, 'SaleOrderLineInvoiceRel', 'invoice_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'uos' => array(self::BELONGS_TO, 'ProductUom', 'uos_id'),
			'product' => array(self::BELONGS_TO, 'ProductProduct', 'product_id'),
			'invoice' => array(self::BELONGS_TO, 'AccountInvoice', 'invoice_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'account' => array(self::BELONGS_TO, 'AccountAccount', 'account_id'),
			'accountAnalytic' => array(self::BELONGS_TO, 'AccountAnalyticAccount', 'account_analytic_id'),
			'accountInvoiceLineTaxes' => array(self::HAS_MANY, 'AccountInvoiceLineTax', 'invoice_line_id'),
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
			'uos_id' => 'Uos',
			'account_id' => 'Account',
			'name' => 'Name',
			'sequence' => 'Sequence',
			'invoice_id' => 'Invoice',
			'price_unit' => 'Price Unit',
			'price_subtotal' => 'Price Subtotal',
			'company_id' => 'Company',
			'discount' => 'Discount',
			'account_analytic_id' => 'Account Analytic',
			'quantity' => 'Quantity',
			'partner_id' => 'Partner',
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
		$criteria->compare('origin',$this->origin,true);
		$criteria->compare('uos_id',$this->uos_id);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('invoice_id',$this->invoice_id);
		$criteria->compare('price_unit',$this->price_unit,true);
		$criteria->compare('price_subtotal',$this->price_subtotal,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('discount',$this->discount,true);
		$criteria->compare('account_analytic_id',$this->account_analytic_id);
		$criteria->compare('quantity',$this->quantity,true);
		$criteria->compare('partner_id',$this->partner_id);
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
	 * @return AccountInvoiceLine the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
