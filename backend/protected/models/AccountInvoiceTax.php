<?php

/**
 * This is the model class for table "account_invoice_tax".
 *
 * The followings are the available columns in table 'account_invoice_tax':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $tax_amount
 * @property integer $account_id
 * @property integer $sequence
 * @property integer $invoice_id
 * @property boolean $manual
 * @property integer $company_id
 * @property string $base_amount
 * @property string $amount
 * @property string $base
 * @property integer $tax_code_id
 * @property integer $account_analytic_id
 * @property integer $base_code_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property AccountTaxCode $taxCode
 * @property AccountInvoice $invoice
 * @property ResUsers $createU
 * @property AccountTaxCode $baseCode
 * @property AccountAccount $account
 * @property AccountAnalyticAccount $accountAnalytic
 */
class AccountInvoiceTax extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_invoice_tax';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_id, name', 'required'),
			array('create_uid, write_uid, account_id, sequence, invoice_id, company_id, tax_code_id, account_analytic_id, base_code_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, tax_amount, manual, base_amount, amount, base', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, tax_amount, account_id, sequence, invoice_id, manual, company_id, base_amount, amount, base, tax_code_id, account_analytic_id, base_code_id, name', 'safe', 'on'=>'search'),
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
			'taxCode' => array(self::BELONGS_TO, 'AccountTaxCode', 'tax_code_id'),
			'invoice' => array(self::BELONGS_TO, 'AccountInvoice', 'invoice_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'baseCode' => array(self::BELONGS_TO, 'AccountTaxCode', 'base_code_id'),
			'account' => array(self::BELONGS_TO, 'AccountAccount', 'account_id'),
			'accountAnalytic' => array(self::BELONGS_TO, 'AccountAnalyticAccount', 'account_analytic_id'),
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
			'tax_amount' => 'Tax Amount',
			'account_id' => 'Account',
			'sequence' => 'Sequence',
			'invoice_id' => 'Invoice',
			'manual' => 'Manual',
			'company_id' => 'Company',
			'base_amount' => 'Base Amount',
			'amount' => 'Amount',
			'base' => 'Base',
			'tax_code_id' => 'Tax Code',
			'account_analytic_id' => 'Account Analytic',
			'base_code_id' => 'Base Code',
			'name' => 'Name',
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
		$criteria->compare('tax_amount',$this->tax_amount,true);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('invoice_id',$this->invoice_id);
		$criteria->compare('manual',$this->manual);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('base_amount',$this->base_amount,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('base',$this->base,true);
		$criteria->compare('tax_code_id',$this->tax_code_id);
		$criteria->compare('account_analytic_id',$this->account_analytic_id);
		$criteria->compare('base_code_id',$this->base_code_id);
		$criteria->compare('name',$this->name,true);

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
	 * @return AccountInvoiceTax the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
