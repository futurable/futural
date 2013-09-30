<?php

/**
 * This is the model class for table "purchase_order".
 *
 * The followings are the available columns in table 'purchase_order':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $origin
 * @property integer $journal_id
 * @property string $date_order
 * @property integer $partner_id
 * @property integer $dest_address_id
 * @property integer $fiscal_position
 * @property string $amount_untaxed
 * @property integer $location_id
 * @property integer $company_id
 * @property string $amount_tax
 * @property string $state
 * @property integer $pricelist_id
 * @property integer $warehouse_id
 * @property integer $payment_term_id
 * @property string $partner_ref
 * @property string $date_approve
 * @property string $amount_total
 * @property string $name
 * @property string $notes
 * @property string $invoice_method
 * @property boolean $shipped
 * @property integer $validator
 * @property string $minimum_planned_date
 *
 * The followings are the available model relations:
 * @property ProcurementOrder[] $procurementOrders
 * @property PurchaseOrderLine[] $purchaseOrderLines
 * @property ResUsers $writeU
 * @property StockWarehouse $warehouse
 * @property ResUsers $validator0
 * @property ProductPricelist $pricelist
 * @property AccountPaymentTerm $paymentTerm
 * @property ResPartner $partner
 * @property StockLocation $location
 * @property AccountJournal $journal
 * @property AccountFiscalPosition $fiscalPosition
 * @property ResPartner $destAddress
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property StockPicking[] $stockPickings
 * @property PurchaseInvoiceRel[] $purchaseInvoiceRels
 */
class PurchaseOrder extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'purchase_order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_order, partner_id, location_id, company_id, pricelist_id, name, invoice_method', 'required'),
			array('create_uid, write_uid, journal_id, partner_id, dest_address_id, fiscal_position, location_id, company_id, pricelist_id, warehouse_id, payment_term_id, validator', 'numerical', 'integerOnly'=>true),
			array('origin, partner_ref, name', 'length', 'max'=>64),
			array('create_date, write_date, amount_untaxed, amount_tax, state, date_approve, amount_total, notes, shipped, minimum_planned_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, origin, journal_id, date_order, partner_id, dest_address_id, fiscal_position, amount_untaxed, location_id, company_id, amount_tax, state, pricelist_id, warehouse_id, payment_term_id, partner_ref, date_approve, amount_total, name, notes, invoice_method, shipped, validator, minimum_planned_date', 'safe', 'on'=>'search'),
            array('create_date,write_date,date_order','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
            array('create_uid,write_uid,warehouse_id','default', 'value'=>'1', 'setOnEmpty'=>false,'on'=>'insert'),
            array('payment_term_id','default', 'value'=>'2', 'setOnEmpty'=>false,'on'=>'insert'),
            array('journal_id','default', 'value'=>'3', 'setOnEmpty'=>false,'on'=>'insert'),
            array('pricelist_id','default', 'value'=>'2', 'setOnEmpty'=>false,'on'=>'insert'),
            array('location_id','default', 'value'=>'12', 'setOnEmpty'=>false,'on'=>'insert'),
            array('state','default', 'value'=>'approved', 'setOnEmpty'=>false,'on'=>'insert'),
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
			'procurementOrders' => array(self::HAS_MANY, 'ProcurementOrder', 'purchase_id'),
			'purchaseOrderLines' => array(self::HAS_MANY, 'PurchaseOrderLine', 'order_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'warehouse' => array(self::BELONGS_TO, 'StockWarehouse', 'warehouse_id'),
			'validator0' => array(self::BELONGS_TO, 'ResUsers', 'validator'),
			'pricelist' => array(self::BELONGS_TO, 'ProductPricelist', 'pricelist_id'),
			'paymentTerm' => array(self::BELONGS_TO, 'AccountPaymentTerm', 'payment_term_id'),
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'location' => array(self::BELONGS_TO, 'StockLocation', 'location_id'),
			'journal' => array(self::BELONGS_TO, 'AccountJournal', 'journal_id'),
			'fiscalPosition' => array(self::BELONGS_TO, 'AccountFiscalPosition', 'fiscal_position'),
			'destAddress' => array(self::BELONGS_TO, 'ResPartner', 'dest_address_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'stockPickings' => array(self::HAS_MANY, 'StockPicking', 'purchase_id'),
			'purchaseInvoiceRels' => array(self::HAS_MANY, 'PurchaseInvoiceRel', 'purchase_id'),
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
			'journal_id' => 'Journal',
			'date_order' => 'Date Order',
			'partner_id' => 'Partner',
			'dest_address_id' => 'Dest Address',
			'fiscal_position' => 'Fiscal Position',
			'amount_untaxed' => 'Amount Untaxed',
			'location_id' => 'Location',
			'company_id' => 'Company',
			'amount_tax' => 'Amount Tax',
			'state' => 'State',
			'pricelist_id' => 'Pricelist',
			'warehouse_id' => 'Warehouse',
			'payment_term_id' => 'Payment Term',
			'partner_ref' => 'Partner Ref',
			'date_approve' => 'Date Approve',
			'amount_total' => 'Amount Total',
			'name' => 'Name',
			'notes' => 'Notes',
			'invoice_method' => 'Invoice Method',
			'shipped' => 'Shipped',
			'validator' => 'Validator',
			'minimum_planned_date' => 'Minimum Planned Date',
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
		$criteria->compare('journal_id',$this->journal_id);
		$criteria->compare('date_order',$this->date_order,true);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('dest_address_id',$this->dest_address_id);
		$criteria->compare('fiscal_position',$this->fiscal_position);
		$criteria->compare('amount_untaxed',$this->amount_untaxed,true);
		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('amount_tax',$this->amount_tax,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('pricelist_id',$this->pricelist_id);
		$criteria->compare('warehouse_id',$this->warehouse_id);
		$criteria->compare('payment_term_id',$this->payment_term_id);
		$criteria->compare('partner_ref',$this->partner_ref,true);
		$criteria->compare('date_approve',$this->date_approve,true);
		$criteria->compare('amount_total',$this->amount_total,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('invoice_method',$this->invoice_method,true);
		$criteria->compare('shipped',$this->shipped);
		$criteria->compare('validator',$this->validator);
		$criteria->compare('minimum_planned_date',$this->minimum_planned_date,true);

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
	 * @return PurchaseOrder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
