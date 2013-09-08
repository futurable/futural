<?php

/**
 * This is the model class for table "sale_order".
 *
 * The followings are the available columns in table 'sale_order':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $origin
 * @property string $order_policy
 * @property integer $shop_id
 * @property string $client_order_ref
 * @property string $date_order
 * @property integer $partner_id
 * @property string $note
 * @property integer $fiscal_position
 * @property integer $user_id
 * @property integer $payment_term
 * @property integer $company_id
 * @property string $amount_tax
 * @property string $state
 * @property integer $pricelist_id
 * @property integer $partner_invoice_id
 * @property string $amount_untaxed
 * @property string $date_confirm
 * @property string $amount_total
 * @property integer $project_id
 * @property string $name
 * @property integer $partner_shipping_id
 * @property string $invoice_quantity
 * @property string $picking_policy
 * @property integer $incoterm
 * @property boolean $shipped
 * @property integer $section_id
 *
 * The followings are the available model relations:
 * @property StockPicking[] $stockPickings
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property SaleShop $shop
 * @property CrmCaseSection $section
 * @property AccountAnalyticAccount $project
 * @property ProductPricelist $pricelist
 * @property AccountPaymentTerm $paymentTerm
 * @property ResPartner $partnerShipping
 * @property ResPartner $partnerInvoice
 * @property ResPartner $partner
 * @property StockIncoterms $incoterm0
 * @property AccountFiscalPosition $fiscalPosition
 * @property ResUsers $createU
 * @property SaleOrderInvoiceRel[] $saleOrderInvoiceRels
 * @property SaleOrderLine[] $saleOrderLines
 * @property SaleOrderCategoryRel[] $saleOrderCategoryRels
 */
class SaleOrder extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sale_order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_policy, shop_id, date_order, partner_id, pricelist_id, partner_invoice_id, name, partner_shipping_id, invoice_quantity, picking_policy', 'required'),
			array('create_uid, write_uid, shop_id, partner_id, fiscal_position, user_id, payment_term, company_id, pricelist_id, partner_invoice_id, project_id, partner_shipping_id, incoterm, section_id', 'numerical', 'integerOnly'=>true),
			array('origin, client_order_ref, name', 'length', 'max'=>64),
			array('create_date, write_date, note, amount_tax, state, amount_untaxed, date_confirm, amount_total, shipped', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, origin, order_policy, shop_id, client_order_ref, date_order, partner_id, note, fiscal_position, user_id, payment_term, company_id, amount_tax, state, pricelist_id, partner_invoice_id, amount_untaxed, date_confirm, amount_total, project_id, name, partner_shipping_id, invoice_quantity, picking_policy, incoterm, shipped, section_id', 'safe', 'on'=>'search'),
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
			'stockPickings' => array(self::HAS_MANY, 'StockPicking', 'sale_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'user' => array(self::BELONGS_TO, 'ResUsers', 'user_id'),
			'shop' => array(self::BELONGS_TO, 'SaleShop', 'shop_id'),
			'section' => array(self::BELONGS_TO, 'CrmCaseSection', 'section_id'),
			'project' => array(self::BELONGS_TO, 'AccountAnalyticAccount', 'project_id'),
			'pricelist' => array(self::BELONGS_TO, 'ProductPricelist', 'pricelist_id'),
			'paymentTerm' => array(self::BELONGS_TO, 'AccountPaymentTerm', 'payment_term'),
			'partnerShipping' => array(self::BELONGS_TO, 'ResPartner', 'partner_shipping_id'),
			'partnerInvoice' => array(self::BELONGS_TO, 'ResPartner', 'partner_invoice_id'),
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'incoterm0' => array(self::BELONGS_TO, 'StockIncoterms', 'incoterm'),
			'fiscalPosition' => array(self::BELONGS_TO, 'AccountFiscalPosition', 'fiscal_position'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'saleOrderInvoiceRels' => array(self::HAS_MANY, 'SaleOrderInvoiceRel', 'order_id'),
			'saleOrderLines' => array(self::HAS_MANY, 'SaleOrderLine', 'order_id'),
			'saleOrderCategoryRels' => array(self::HAS_MANY, 'SaleOrderCategoryRel', 'order_id'),
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
			'order_policy' => 'Order Policy',
			'shop_id' => 'Shop',
			'client_order_ref' => 'Client Order Ref',
			'date_order' => 'Date Order',
			'partner_id' => 'Partner',
			'note' => 'Note',
			'fiscal_position' => 'Fiscal Position',
			'user_id' => 'User',
			'payment_term' => 'Payment Term',
			'company_id' => 'Company',
			'amount_tax' => 'Amount Tax',
			'state' => 'State',
			'pricelist_id' => 'Pricelist',
			'partner_invoice_id' => 'Partner Invoice',
			'amount_untaxed' => 'Amount Untaxed',
			'date_confirm' => 'Date Confirm',
			'amount_total' => 'Amount Total',
			'project_id' => 'Project',
			'name' => 'Name',
			'partner_shipping_id' => 'Partner Shipping',
			'invoice_quantity' => 'Invoice Quantity',
			'picking_policy' => 'Picking Policy',
			'incoterm' => 'Incoterm',
			'shipped' => 'Shipped',
			'section_id' => 'Section',
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
		$criteria->compare('order_policy',$this->order_policy,true);
		$criteria->compare('shop_id',$this->shop_id);
		$criteria->compare('client_order_ref',$this->client_order_ref,true);
		$criteria->compare('date_order',$this->date_order,true);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('fiscal_position',$this->fiscal_position);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('payment_term',$this->payment_term);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('amount_tax',$this->amount_tax,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('pricelist_id',$this->pricelist_id);
		$criteria->compare('partner_invoice_id',$this->partner_invoice_id);
		$criteria->compare('amount_untaxed',$this->amount_untaxed,true);
		$criteria->compare('date_confirm',$this->date_confirm,true);
		$criteria->compare('amount_total',$this->amount_total,true);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('partner_shipping_id',$this->partner_shipping_id);
		$criteria->compare('invoice_quantity',$this->invoice_quantity,true);
		$criteria->compare('picking_policy',$this->picking_policy,true);
		$criteria->compare('incoterm',$this->incoterm);
		$criteria->compare('shipped',$this->shipped);
		$criteria->compare('section_id',$this->section_id);

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
	 * @return SaleOrder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
