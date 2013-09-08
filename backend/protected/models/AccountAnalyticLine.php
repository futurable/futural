<?php

/**
 * This is the model class for table "account_analytic_line".
 *
 * The followings are the available columns in table 'account_analytic_line':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $amount
 * @property integer $user_id
 * @property string $name
 * @property double $unit_amount
 * @property string $date
 * @property integer $company_id
 * @property integer $account_id
 * @property string $code
 * @property integer $general_account_id
 * @property integer $currency_id
 * @property integer $move_id
 * @property integer $product_id
 * @property integer $product_uom_id
 * @property integer $journal_id
 * @property string $amount_currency
 * @property string $ref
 * @property integer $to_invoice
 * @property integer $invoice_id
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property HrTimesheetInvoiceFactor $toInvoice
 * @property ProductUom $productUom
 * @property ProductProduct $product
 * @property AccountMoveLine $move
 * @property AccountAnalyticJournal $journal
 * @property AccountInvoice $invoice
 * @property AccountAccount $generalAccount
 * @property ResUsers $createU
 * @property AccountAnalyticAccount $account
 * @property HrAnalyticTimesheet[] $hrAnalyticTimesheets
 */
class AccountAnalyticLine extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_analytic_line';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('amount, name, date, account_id, general_account_id, journal_id', 'required'),
			array('create_uid, write_uid, user_id, company_id, account_id, general_account_id, currency_id, move_id, product_id, product_uom_id, journal_id, to_invoice, invoice_id', 'numerical', 'integerOnly'=>true),
			array('unit_amount', 'numerical'),
			array('name', 'length', 'max'=>256),
			array('code', 'length', 'max'=>8),
			array('ref', 'length', 'max'=>64),
			array('create_date, write_date, amount_currency', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, amount, user_id, name, unit_amount, date, company_id, account_id, code, general_account_id, currency_id, move_id, product_id, product_uom_id, journal_id, amount_currency, ref, to_invoice, invoice_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'ResUsers', 'user_id'),
			'toInvoice' => array(self::BELONGS_TO, 'HrTimesheetInvoiceFactor', 'to_invoice'),
			'productUom' => array(self::BELONGS_TO, 'ProductUom', 'product_uom_id'),
			'product' => array(self::BELONGS_TO, 'ProductProduct', 'product_id'),
			'move' => array(self::BELONGS_TO, 'AccountMoveLine', 'move_id'),
			'journal' => array(self::BELONGS_TO, 'AccountAnalyticJournal', 'journal_id'),
			'invoice' => array(self::BELONGS_TO, 'AccountInvoice', 'invoice_id'),
			'generalAccount' => array(self::BELONGS_TO, 'AccountAccount', 'general_account_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'account' => array(self::BELONGS_TO, 'AccountAnalyticAccount', 'account_id'),
			'hrAnalyticTimesheets' => array(self::HAS_MANY, 'HrAnalyticTimesheet', 'line_id'),
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
			'amount' => 'Amount',
			'user_id' => 'User',
			'name' => 'Name',
			'unit_amount' => 'Unit Amount',
			'date' => 'Date',
			'company_id' => 'Company',
			'account_id' => 'Account',
			'code' => 'Code',
			'general_account_id' => 'General Account',
			'currency_id' => 'Currency',
			'move_id' => 'Move',
			'product_id' => 'Product',
			'product_uom_id' => 'Product Uom',
			'journal_id' => 'Journal',
			'amount_currency' => 'Amount Currency',
			'ref' => 'Ref',
			'to_invoice' => 'To Invoice',
			'invoice_id' => 'Invoice',
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
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('unit_amount',$this->unit_amount);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('general_account_id',$this->general_account_id);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('move_id',$this->move_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('product_uom_id',$this->product_uom_id);
		$criteria->compare('journal_id',$this->journal_id);
		$criteria->compare('amount_currency',$this->amount_currency,true);
		$criteria->compare('ref',$this->ref,true);
		$criteria->compare('to_invoice',$this->to_invoice);
		$criteria->compare('invoice_id',$this->invoice_id);

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
	 * @return AccountAnalyticLine the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
