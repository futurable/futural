<?php

/**
 * This is the model class for table "account_report_general_ledger".
 *
 * The followings are the available columns in table 'account_report_general_ledger':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property boolean $initial_balance
 * @property integer $chart_account_id
 * @property string $date_from
 * @property integer $period_to
 * @property string $filter
 * @property integer $period_from
 * @property integer $fiscalyear_id
 * @property string $sortby
 * @property string $target_move
 * @property string $date_to
 * @property boolean $amount_currency
 * @property string $display_account
 * @property boolean $landscape
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property AccountPeriod $periodTo
 * @property AccountPeriod $periodFrom
 * @property AccountFiscalyear $fiscalyear
 * @property ResUsers $createU
 * @property AccountAccount $chartAccount
 * @property AccountReportGeneralLedgerJournalRel[] $accountReportGeneralLedgerJournalRels
 */
class AccountReportGeneralLedger extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_report_general_ledger';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('chart_account_id, filter, sortby, target_move, display_account', 'required'),
			array('create_uid, write_uid, chart_account_id, period_to, period_from, fiscalyear_id', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date, initial_balance, date_from, date_to, amount_currency, landscape', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, initial_balance, chart_account_id, date_from, period_to, filter, period_from, fiscalyear_id, sortby, target_move, date_to, amount_currency, display_account, landscape', 'safe', 'on'=>'search'),
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
			'periodTo' => array(self::BELONGS_TO, 'AccountPeriod', 'period_to'),
			'periodFrom' => array(self::BELONGS_TO, 'AccountPeriod', 'period_from'),
			'fiscalyear' => array(self::BELONGS_TO, 'AccountFiscalyear', 'fiscalyear_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'chartAccount' => array(self::BELONGS_TO, 'AccountAccount', 'chart_account_id'),
			'accountReportGeneralLedgerJournalRels' => array(self::HAS_MANY, 'AccountReportGeneralLedgerJournalRel', 'account_id'),
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
			'initial_balance' => 'Initial Balance',
			'chart_account_id' => 'Chart Account',
			'date_from' => 'Date From',
			'period_to' => 'Period To',
			'filter' => 'Filter',
			'period_from' => 'Period From',
			'fiscalyear_id' => 'Fiscalyear',
			'sortby' => 'Sortby',
			'target_move' => 'Target Move',
			'date_to' => 'Date To',
			'amount_currency' => 'Amount Currency',
			'display_account' => 'Display Account',
			'landscape' => 'Landscape',
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
		$criteria->compare('initial_balance',$this->initial_balance);
		$criteria->compare('chart_account_id',$this->chart_account_id);
		$criteria->compare('date_from',$this->date_from,true);
		$criteria->compare('period_to',$this->period_to);
		$criteria->compare('filter',$this->filter,true);
		$criteria->compare('period_from',$this->period_from);
		$criteria->compare('fiscalyear_id',$this->fiscalyear_id);
		$criteria->compare('sortby',$this->sortby,true);
		$criteria->compare('target_move',$this->target_move,true);
		$criteria->compare('date_to',$this->date_to,true);
		$criteria->compare('amount_currency',$this->amount_currency);
		$criteria->compare('display_account',$this->display_account,true);
		$criteria->compare('landscape',$this->landscape);

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
	 * @return AccountReportGeneralLedger the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}