<?php

/**
 * This is the model class for table "account_bank_statement_line".
 *
 * The followings are the available columns in table 'account_bank_statement_line':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $analytic_account_id
 * @property string $ref
 * @property integer $statement_id
 * @property integer $sequence
 * @property string $type
 * @property integer $company_id
 * @property string $name
 * @property string $note
 * @property integer $journal_id
 * @property string $amount
 * @property string $date
 * @property integer $partner_id
 * @property integer $account_id
 * @property integer $voucher_id
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property AccountVoucher $voucher
 * @property AccountBankStatement $statement
 * @property ResPartner $partner
 * @property ResUsers $createU
 * @property AccountAnalyticAccount $analyticAccount
 * @property AccountAccount $account
 * @property AccountBankStatementLineMoveRel[] $accountBankStatementLineMoveRels
 */
class AccountBankStatementLine extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_bank_statement_line';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('statement_id, type, name, date, account_id', 'required'),
			array('create_uid, write_uid, analytic_account_id, statement_id, sequence, company_id, journal_id, partner_id, account_id, voucher_id', 'numerical', 'integerOnly'=>true),
			array('ref', 'length', 'max'=>32),
			array('create_date, write_date, note, amount', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, analytic_account_id, ref, statement_id, sequence, type, company_id, name, note, journal_id, amount, date, partner_id, account_id, voucher_id', 'safe', 'on'=>'search'),
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
			'voucher' => array(self::BELONGS_TO, 'AccountVoucher', 'voucher_id'),
			'statement' => array(self::BELONGS_TO, 'AccountBankStatement', 'statement_id'),
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'analyticAccount' => array(self::BELONGS_TO, 'AccountAnalyticAccount', 'analytic_account_id'),
			'account' => array(self::BELONGS_TO, 'AccountAccount', 'account_id'),
			'accountBankStatementLineMoveRels' => array(self::HAS_MANY, 'AccountBankStatementLineMoveRel', 'statement_line_id'),
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
			'analytic_account_id' => 'Analytic Account',
			'ref' => 'Ref',
			'statement_id' => 'Statement',
			'sequence' => 'Sequence',
			'type' => 'Type',
			'company_id' => 'Company',
			'name' => 'Name',
			'note' => 'Note',
			'journal_id' => 'Journal',
			'amount' => 'Amount',
			'date' => 'Date',
			'partner_id' => 'Partner',
			'account_id' => 'Account',
			'voucher_id' => 'Voucher',
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
		$criteria->compare('analytic_account_id',$this->analytic_account_id);
		$criteria->compare('ref',$this->ref,true);
		$criteria->compare('statement_id',$this->statement_id);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('journal_id',$this->journal_id);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('voucher_id',$this->voucher_id);

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
	 * @return AccountBankStatementLine the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
