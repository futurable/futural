<?php

/**
 * This is the model class for table "account_voucher".
 *
 * The followings are the available columns in table 'account_voucher':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $comment
 * @property string $date_due
 * @property boolean $is_multi_currency
 * @property string $reference
 * @property string $number
 * @property integer $writeoff_acc_id
 * @property string $date
 * @property string $narration
 * @property integer $partner_id
 * @property integer $payment_rate_currency_id
 * @property string $pay_now
 * @property integer $company_id
 * @property string $state
 * @property boolean $pre_line
 * @property string $payment_rate
 * @property string $type
 * @property string $payment_option
 * @property integer $account_id
 * @property integer $period_id
 * @property boolean $active
 * @property integer $move_id
 * @property integer $tax_id
 * @property string $tax_amount
 * @property string $name
 * @property integer $analytic_id
 * @property integer $journal_id
 * @property string $amount
 *
 * The followings are the available model relations:
 * @property AccountBankStatementLine[] $accountBankStatementLines
 * @property AccountVoucherLine[] $accountVoucherLines
 * @property AccountAccount $writeoffAcc
 * @property ResUsers $writeU
 * @property AccountTax $tax
 * @property AccountPeriod $period
 * @property ResCurrency $paymentRateCurrency
 * @property ResPartner $partner
 * @property AccountMove $move
 * @property AccountJournal $journal
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property AccountAnalyticAccount $analytic
 * @property AccountAccount $account
 */
class AccountVoucher extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_voucher';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comment, payment_rate_currency_id, company_id, payment_rate, payment_option, account_id, period_id, journal_id, amount', 'required'),
			array('create_uid, write_uid, writeoff_acc_id, partner_id, payment_rate_currency_id, company_id, account_id, period_id, move_id, tax_id, analytic_id, journal_id', 'numerical', 'integerOnly'=>true),
			array('comment, reference', 'length', 'max'=>64),
			array('number, state', 'length', 'max'=>32),
			array('name', 'length', 'max'=>256),
			array('create_date, write_date, date_due, is_multi_currency, date, narration, pay_now, pre_line, type, active, tax_amount', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, comment, date_due, is_multi_currency, reference, number, writeoff_acc_id, date, narration, partner_id, payment_rate_currency_id, pay_now, company_id, state, pre_line, payment_rate, type, payment_option, account_id, period_id, active, move_id, tax_id, tax_amount, name, analytic_id, journal_id, amount', 'safe', 'on'=>'search'),
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
			'accountBankStatementLines' => array(self::HAS_MANY, 'AccountBankStatementLine', 'voucher_id'),
			'accountVoucherLines' => array(self::HAS_MANY, 'AccountVoucherLine', 'voucher_id'),
			'writeoffAcc' => array(self::BELONGS_TO, 'AccountAccount', 'writeoff_acc_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'tax' => array(self::BELONGS_TO, 'AccountTax', 'tax_id'),
			'period' => array(self::BELONGS_TO, 'AccountPeriod', 'period_id'),
			'paymentRateCurrency' => array(self::BELONGS_TO, 'ResCurrency', 'payment_rate_currency_id'),
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'move' => array(self::BELONGS_TO, 'AccountMove', 'move_id'),
			'journal' => array(self::BELONGS_TO, 'AccountJournal', 'journal_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'analytic' => array(self::BELONGS_TO, 'AccountAnalyticAccount', 'analytic_id'),
			'account' => array(self::BELONGS_TO, 'AccountAccount', 'account_id'),
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
			'comment' => 'Comment',
			'date_due' => 'Date Due',
			'is_multi_currency' => 'Is Multi Currency',
			'reference' => 'Reference',
			'number' => 'Number',
			'writeoff_acc_id' => 'Writeoff Acc',
			'date' => 'Date',
			'narration' => 'Narration',
			'partner_id' => 'Partner',
			'payment_rate_currency_id' => 'Payment Rate Currency',
			'pay_now' => 'Pay Now',
			'company_id' => 'Company',
			'state' => 'State',
			'pre_line' => 'Pre Line',
			'payment_rate' => 'Payment Rate',
			'type' => 'Type',
			'payment_option' => 'Payment Option',
			'account_id' => 'Account',
			'period_id' => 'Period',
			'active' => 'Active',
			'move_id' => 'Move',
			'tax_id' => 'Tax',
			'tax_amount' => 'Tax Amount',
			'name' => 'Name',
			'analytic_id' => 'Analytic',
			'journal_id' => 'Journal',
			'amount' => 'Amount',
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
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('date_due',$this->date_due,true);
		$criteria->compare('is_multi_currency',$this->is_multi_currency);
		$criteria->compare('reference',$this->reference,true);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('writeoff_acc_id',$this->writeoff_acc_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('narration',$this->narration,true);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('payment_rate_currency_id',$this->payment_rate_currency_id);
		$criteria->compare('pay_now',$this->pay_now,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('pre_line',$this->pre_line);
		$criteria->compare('payment_rate',$this->payment_rate,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('payment_option',$this->payment_option,true);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('period_id',$this->period_id);
		$criteria->compare('active',$this->active);
		$criteria->compare('move_id',$this->move_id);
		$criteria->compare('tax_id',$this->tax_id);
		$criteria->compare('tax_amount',$this->tax_amount,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('analytic_id',$this->analytic_id);
		$criteria->compare('journal_id',$this->journal_id);
		$criteria->compare('amount',$this->amount,true);

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
	 * @return AccountVoucher the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
