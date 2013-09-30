<?php

/**
 * This is the model class for table "account_invoice".
 *
 * The followings are the available columns in table 'account_invoice':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $origin
 * @property string $date_due
 * @property string $check_total
 * @property string $reference
 * @property string $supplier_invoice_number
 * @property string $number
 * @property integer $account_id
 * @property integer $company_id
 * @property integer $currency_id
 * @property integer $partner_id
 * @property integer $fiscal_position
 * @property integer $user_id
 * @property integer $partner_bank_id
 * @property integer $payment_term
 * @property string $reference_type
 * @property integer $journal_id
 * @property string $amount_tax
 * @property string $state
 * @property string $type
 * @property string $internal_number
 * @property boolean $reconciled
 * @property string $residual
 * @property string $move_name
 * @property string $date_invoice
 * @property integer $period_id
 * @property string $amount_untaxed
 * @property integer $move_id
 * @property string $amount_total
 * @property string $name
 * @property string $comment
 * @property boolean $sent
 * @property integer $section_id
 *
 * The followings are the available model relations:
 * @property AccountAnalyticLine[] $accountAnalyticLines
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property CrmCaseSection $section
 * @property AccountPeriod $period
 * @property AccountPaymentTerm $paymentTerm
 * @property ResPartner $partner
 * @property ResPartnerBank $partnerBank
 * @property AccountMove $move
 * @property AccountJournal $journal
 * @property AccountFiscalPosition $fiscalPosition
 * @property ResCurrency $currency
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property AccountAccount $account
 * @property AccountInvoiceTax[] $accountInvoiceTaxes
 * @property SaleOrderInvoiceRel[] $saleOrderInvoiceRels
 * @property AccountInvoiceLine[] $accountInvoiceLines
 * @property PurchaseInvoiceRel[] $purchaseInvoiceRels
 */
class AccountInvoice extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_invoice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, partner_id', 'required'),
			array('create_uid, write_uid, account_id, company_id, currency_id, partner_id, fiscal_position, user_id, partner_bank_id, payment_term, journal_id, period_id, move_id, section_id', 'numerical', 'integerOnly'=>true),
			array('origin, reference, supplier_invoice_number, number, move_name, name', 'length', 'max'=>64),
			array('internal_number', 'length', 'max'=>32),
			array('create_date, write_date, date_due, check_total, amount_tax, state, type, reconciled, residual, date_invoice, amount_untaxed, amount_total, comment, sent', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, origin, date_due, check_total, reference, supplier_invoice_number, number, account_id, company_id, currency_id, partner_id, fiscal_position, user_id, partner_bank_id, payment_term, reference_type, journal_id, amount_tax, state, type, internal_number, reconciled, residual, move_name, date_invoice, period_id, amount_untaxed, move_id, amount_total, name, comment, sent, section_id', 'safe', 'on'=>'search'),
            array('create_date,write_date','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
            array('create_uid,write_uid,currency_id,user_id','default', 'value'=>'1', 'setOnEmpty'=>false,'on'=>'insert'),
            array('account_id','default', 'value'=>'13', 'setOnEmpty'=>false,'on'=>'insert'),
            array('journal_id','default', 'value'=>'340', 'setOnEmpty'=>false,'on'=>'insert'),
            array('reference_type','default', 'value'=>'none', 'setOnEmpty'=>false,'on'=>'insert'),
            array('type','default', 'value'=>'in_invoice', 'setOnEmpty'=>false,'on'=>'insert'),
            array('state','default', 'value'=>'draft', 'setOnEmpty'=>false,'on'=>'insert'),
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
			'accountAnalyticLines' => array(self::HAS_MANY, 'AccountAnalyticLine', 'invoice_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'user' => array(self::BELONGS_TO, 'ResUsers', 'user_id'),
			'section' => array(self::BELONGS_TO, 'CrmCaseSection', 'section_id'),
			'period' => array(self::BELONGS_TO, 'AccountPeriod', 'period_id'),
			'paymentTerm' => array(self::BELONGS_TO, 'AccountPaymentTerm', 'payment_term'),
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'partnerBank' => array(self::BELONGS_TO, 'ResPartnerBank', 'partner_bank_id'),
			'move' => array(self::BELONGS_TO, 'AccountMove', 'move_id'),
			'journal' => array(self::BELONGS_TO, 'AccountJournal', 'journal_id'),
			'fiscalPosition' => array(self::BELONGS_TO, 'AccountFiscalPosition', 'fiscal_position'),
			'currency' => array(self::BELONGS_TO, 'ResCurrency', 'currency_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'account' => array(self::BELONGS_TO, 'AccountAccount', 'account_id'),
			'accountInvoiceTaxes' => array(self::HAS_MANY, 'AccountInvoiceTax', 'invoice_id'),
			'saleOrderInvoiceRels' => array(self::HAS_MANY, 'SaleOrderInvoiceRel', 'invoice_id'),
			'accountInvoiceLines' => array(self::HAS_MANY, 'AccountInvoiceLine', 'invoice_id'),
			'purchaseInvoiceRels' => array(self::HAS_MANY, 'PurchaseInvoiceRel', 'invoice_id'),
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
			'date_due' => 'Date Due',
			'check_total' => 'Check Total',
			'reference' => 'Reference',
			'supplier_invoice_number' => 'Supplier Invoice Number',
			'number' => 'Number',
			'account_id' => 'Account',
			'company_id' => 'Company',
			'currency_id' => 'Currency',
			'partner_id' => 'Partner',
			'fiscal_position' => 'Fiscal Position',
			'user_id' => 'User',
			'partner_bank_id' => 'Partner Bank',
			'payment_term' => 'Payment Term',
			'reference_type' => 'Reference Type',
			'journal_id' => 'Journal',
			'amount_tax' => 'Amount Tax',
			'state' => 'State',
			'type' => 'Type',
			'internal_number' => 'Internal Number',
			'reconciled' => 'Reconciled',
			'residual' => 'Residual',
			'move_name' => 'Move Name',
			'date_invoice' => 'Date Invoice',
			'period_id' => 'Period',
			'amount_untaxed' => 'Amount Untaxed',
			'move_id' => 'Move',
			'amount_total' => 'Amount Total',
			'name' => 'Name',
			'comment' => 'Comment',
			'sent' => 'Sent',
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
		$criteria->compare('date_due',$this->date_due,true);
		$criteria->compare('check_total',$this->check_total,true);
		$criteria->compare('reference',$this->reference,true);
		$criteria->compare('supplier_invoice_number',$this->supplier_invoice_number,true);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('fiscal_position',$this->fiscal_position);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('partner_bank_id',$this->partner_bank_id);
		$criteria->compare('payment_term',$this->payment_term);
		$criteria->compare('reference_type',$this->reference_type,true);
		$criteria->compare('journal_id',$this->journal_id);
		$criteria->compare('amount_tax',$this->amount_tax,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('internal_number',$this->internal_number,true);
		$criteria->compare('reconciled',$this->reconciled);
		$criteria->compare('residual',$this->residual,true);
		$criteria->compare('move_name',$this->move_name,true);
		$criteria->compare('date_invoice',$this->date_invoice,true);
		$criteria->compare('period_id',$this->period_id);
		$criteria->compare('amount_untaxed',$this->amount_untaxed,true);
		$criteria->compare('move_id',$this->move_id);
		$criteria->compare('amount_total',$this->amount_total,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('sent',$this->sent);
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
	 * @return AccountInvoice the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
