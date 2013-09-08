<?php

/**
 * This is the model class for table "account_move".
 *
 * The followings are the available columns in table 'account_move':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $name
 * @property string $state
 * @property string $ref
 * @property integer $company_id
 * @property integer $journal_id
 * @property integer $period_id
 * @property string $narration
 * @property string $date
 * @property string $balance
 * @property integer $partner_id
 * @property boolean $to_check
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property AccountPeriod $period
 * @property AccountJournal $journal
 * @property ResUsers $createU
 * @property AccountMoveLine[] $accountMoveLines
 * @property AccountInvoice[] $accountInvoices
 * @property AccountSubscriptionLine[] $accountSubscriptionLines
 * @property AccountBankStatementLineMoveRel[] $accountBankStatementLineMoveRels
 * @property AccountVoucher[] $accountVouchers
 */
class AccountMove extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_move';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, state, journal_id, period_id, date', 'required'),
			array('create_uid, write_uid, company_id, journal_id, period_id, partner_id', 'numerical', 'integerOnly'=>true),
			array('name, ref', 'length', 'max'=>64),
			array('create_date, write_date, narration, balance, to_check', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, name, state, ref, company_id, journal_id, period_id, narration, date, balance, partner_id, to_check', 'safe', 'on'=>'search'),
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
			'period' => array(self::BELONGS_TO, 'AccountPeriod', 'period_id'),
			'journal' => array(self::BELONGS_TO, 'AccountJournal', 'journal_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'accountMoveLines' => array(self::HAS_MANY, 'AccountMoveLine', 'move_id'),
			'accountInvoices' => array(self::HAS_MANY, 'AccountInvoice', 'move_id'),
			'accountSubscriptionLines' => array(self::HAS_MANY, 'AccountSubscriptionLine', 'move_id'),
			'accountBankStatementLineMoveRels' => array(self::HAS_MANY, 'AccountBankStatementLineMoveRel', 'move_id'),
			'accountVouchers' => array(self::HAS_MANY, 'AccountVoucher', 'move_id'),
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
			'name' => 'Name',
			'state' => 'State',
			'ref' => 'Ref',
			'company_id' => 'Company',
			'journal_id' => 'Journal',
			'period_id' => 'Period',
			'narration' => 'Narration',
			'date' => 'Date',
			'balance' => 'Balance',
			'partner_id' => 'Partner',
			'to_check' => 'To Check',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('ref',$this->ref,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('journal_id',$this->journal_id);
		$criteria->compare('period_id',$this->period_id);
		$criteria->compare('narration',$this->narration,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('balance',$this->balance,true);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('to_check',$this->to_check);

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
	 * @return AccountMove the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
