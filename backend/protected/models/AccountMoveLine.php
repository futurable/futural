<?php

/**
 * This is the model class for table "account_move_line".
 *
 * The followings are the available columns in table 'account_move_line':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $statement_id
 * @property integer $journal_id
 * @property integer $currency_id
 * @property string $date_maturity
 * @property integer $partner_id
 * @property integer $reconcile_partial_id
 * @property integer $analytic_account_id
 * @property string $credit
 * @property string $centralisation
 * @property integer $company_id
 * @property integer $tax_code_id
 * @property string $state
 * @property string $debit
 * @property boolean $blocked
 * @property string $ref
 * @property integer $account_id
 * @property integer $period_id
 * @property string $date_created
 * @property string $date
 * @property integer $move_id
 * @property string $name
 * @property integer $reconcile_id
 * @property string $tax_amount
 * @property integer $product_id
 * @property integer $account_tax_id
 * @property integer $product_uom_id
 * @property string $amount_currency
 * @property string $quantity
 *
 * The followings are the available model relations:
 * @property AccountAnalyticLine[] $accountAnalyticLines
 * @property ResUsers $writeU
 * @property AccountTaxCode $taxCode
 * @property AccountBankStatement $statement
 * @property AccountMoveReconcile $reconcilePartial
 * @property AccountMoveReconcile $reconcile
 * @property ProductUom $productUom
 * @property ProductProduct $product
 * @property ResPartner $partner
 * @property AccountMove $move
 * @property ResCurrency $currency
 * @property ResUsers $createU
 * @property AccountAnalyticAccount $analyticAccount
 * @property AccountTax $accountTax
 * @property AccountAccount $account
 * @property AccountMoveLineRelation[] $accountMoveLineRelations
 * @property AccountVoucherLine[] $accountVoucherLines
 */
class AccountMoveLine extends CActiveRecord
{
    public $week;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_move_line';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('journal_id, account_id, period_id, date, move_id, name', 'required'),
			array('create_uid, write_uid, statement_id, journal_id, currency_id, partner_id, reconcile_partial_id, analytic_account_id, company_id, tax_code_id, account_id, period_id, move_id, reconcile_id, product_id, account_tax_id, product_uom_id', 'numerical', 'integerOnly'=>true),
			array('centralisation', 'length', 'max'=>8),
			array('ref, name', 'length', 'max'=>64),
			array('create_date, write_date, date_maturity, credit, state, debit, blocked, date_created, tax_amount, amount_currency, quantity', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, statement_id, journal_id, currency_id, date_maturity, partner_id, reconcile_partial_id, analytic_account_id, credit, centralisation, company_id, tax_code_id, state, debit, blocked, ref, account_id, period_id, date_created, date, move_id, name, reconcile_id, tax_amount, product_id, account_tax_id, product_uom_id, amount_currency, quantity', 'safe', 'on'=>'search'),
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
			'accountAnalyticLines' => array(self::HAS_MANY, 'AccountAnalyticLine', 'move_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'taxCode' => array(self::BELONGS_TO, 'AccountTaxCode', 'tax_code_id'),
			'statement' => array(self::BELONGS_TO, 'AccountBankStatement', 'statement_id'),
			'reconcilePartial' => array(self::BELONGS_TO, 'AccountMoveReconcile', 'reconcile_partial_id'),
			'reconcile' => array(self::BELONGS_TO, 'AccountMoveReconcile', 'reconcile_id'),
			'productUom' => array(self::BELONGS_TO, 'ProductUom', 'product_uom_id'),
			'product' => array(self::BELONGS_TO, 'ProductProduct', 'product_id'),
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'move' => array(self::BELONGS_TO, 'AccountMove', 'move_id'),
			'currency' => array(self::BELONGS_TO, 'ResCurrency', 'currency_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'analyticAccount' => array(self::BELONGS_TO, 'AccountAnalyticAccount', 'analytic_account_id'),
			'accountTax' => array(self::BELONGS_TO, 'AccountTax', 'account_tax_id'),
			'account' => array(self::BELONGS_TO, 'AccountAccount', 'account_id'),
			'accountMoveLineRelations' => array(self::HAS_MANY, 'AccountMoveLineRelation', 'line_id'),
			'accountVoucherLines' => array(self::HAS_MANY, 'AccountVoucherLine', 'move_line_id'),
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
			'statement_id' => 'Statement',
			'journal_id' => 'Journal',
			'currency_id' => 'Currency',
			'date_maturity' => 'Date Maturity',
			'partner_id' => 'Partner',
			'reconcile_partial_id' => 'Reconcile Partial',
			'analytic_account_id' => 'Analytic Account',
			'credit' => 'Credit',
			'centralisation' => 'Centralisation',
			'company_id' => 'Company',
			'tax_code_id' => 'Tax Code',
			'state' => 'State',
			'debit' => 'Debit',
			'blocked' => 'Blocked',
			'ref' => 'Ref',
			'account_id' => 'Account',
			'period_id' => 'Period',
			'date_created' => 'Date Created',
			'date' => 'Date',
			'move_id' => 'Move',
			'name' => 'Name',
			'reconcile_id' => 'Reconcile',
			'tax_amount' => 'Tax Amount',
			'product_id' => 'Product',
			'account_tax_id' => 'Account Tax',
			'product_uom_id' => 'Product Uom',
			'amount_currency' => 'Amount Currency',
			'quantity' => 'Quantity',
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
		$criteria->compare('statement_id',$this->statement_id);
		$criteria->compare('journal_id',$this->journal_id);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('date_maturity',$this->date_maturity,true);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('reconcile_partial_id',$this->reconcile_partial_id);
		$criteria->compare('analytic_account_id',$this->analytic_account_id);
		$criteria->compare('credit',$this->credit,true);
		$criteria->compare('centralisation',$this->centralisation,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('tax_code_id',$this->tax_code_id);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('debit',$this->debit,true);
		$criteria->compare('blocked',$this->blocked);
		$criteria->compare('ref',$this->ref,true);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('period_id',$this->period_id);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('move_id',$this->move_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('reconcile_id',$this->reconcile_id);
		$criteria->compare('tax_amount',$this->tax_amount,true);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('account_tax_id',$this->account_tax_id);
		$criteria->compare('product_uom_id',$this->product_uom_id);
		$criteria->compare('amount_currency',$this->amount_currency,true);
		$criteria->compare('quantity',$this->quantity,true);

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
	 * @return AccountMoveLine the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
