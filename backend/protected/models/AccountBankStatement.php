<?php

/**
 * This is the model class for table "account_bank_statement".
 *
 * The followings are the available columns in table 'account_bank_statement':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $balance_start
 * @property integer $journal_id
 * @property integer $period_id
 * @property string $total_entry_encoding
 * @property string $date
 * @property integer $user_id
 * @property string $name
 * @property string $closing_date
 * @property string $balance_end
 * @property integer $company_id
 * @property string $state
 * @property string $balance_end_real
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property AccountPeriod $period
 * @property AccountJournal $journal
 * @property ResUsers $createU
 * @property AccountBankStatementLine[] $accountBankStatementLines
 * @property AccountCashboxLine[] $accountCashboxLines
 * @property AccountMoveLine[] $accountMoveLines
 */
class AccountBankStatement extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_bank_statement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('journal_id, period_id, date, name, state', 'required'),
			array('create_uid, write_uid, journal_id, period_id, user_id, company_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, balance_start, total_entry_encoding, closing_date, balance_end, balance_end_real', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, balance_start, journal_id, period_id, total_entry_encoding, date, user_id, name, closing_date, balance_end, company_id, state, balance_end_real', 'safe', 'on'=>'search'),
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
			'period' => array(self::BELONGS_TO, 'AccountPeriod', 'period_id'),
			'journal' => array(self::BELONGS_TO, 'AccountJournal', 'journal_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'accountBankStatementLines' => array(self::HAS_MANY, 'AccountBankStatementLine', 'statement_id'),
			'accountCashboxLines' => array(self::HAS_MANY, 'AccountCashboxLine', 'bank_statement_id'),
			'accountMoveLines' => array(self::HAS_MANY, 'AccountMoveLine', 'statement_id'),
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
			'balance_start' => 'Balance Start',
			'journal_id' => 'Journal',
			'period_id' => 'Period',
			'total_entry_encoding' => 'Total Entry Encoding',
			'date' => 'Date',
			'user_id' => 'User',
			'name' => 'Name',
			'closing_date' => 'Closing Date',
			'balance_end' => 'Balance End',
			'company_id' => 'Company',
			'state' => 'State',
			'balance_end_real' => 'Balance End Real',
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
		$criteria->compare('balance_start',$this->balance_start,true);
		$criteria->compare('journal_id',$this->journal_id);
		$criteria->compare('period_id',$this->period_id);
		$criteria->compare('total_entry_encoding',$this->total_entry_encoding,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('closing_date',$this->closing_date,true);
		$criteria->compare('balance_end',$this->balance_end,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('balance_end_real',$this->balance_end_real,true);

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
	 * @return AccountBankStatement the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
