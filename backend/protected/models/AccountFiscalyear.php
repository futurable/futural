<?php

/**
 * This is the model class for table "account_fiscalyear".
 *
 * The followings are the available columns in table 'account_fiscalyear':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $date_stop
 * @property string $code
 * @property string $name
 * @property integer $end_journal_period_id
 * @property string $date_start
 * @property integer $company_id
 * @property string $state
 *
 * The followings are the available model relations:
 * @property AccountAgedTrialBalance[] $accountAgedTrialBalances
 * @property AccountBalanceReport[] $accountBalanceReports
 * @property AccountCommonAccountReport[] $accountCommonAccountReports
 * @property AccountCentralJournal[] $accountCentralJournals
 * @property AccountChart[] $accountCharts
 * @property AccountCommonJournalReport[] $accountCommonJournalReports
 * @property AccountCommonPartnerReport[] $accountCommonPartnerReports
 * @property AccountCommonReport[] $accountCommonReports
 * @property AccountFiscalyearCloseState[] $accountFiscalyearCloseStates
 * @property AccountPeriod[] $accountPeriods
 * @property AccountGeneralJournal[] $accountGeneralJournals
 * @property AccountFiscalyearClose[] $accountFiscalyearCloses
 * @property AccountFiscalyearClose[] $accountFiscalyearCloses1
 * @property AccountPartnerLedger[] $accountPartnerLedgers
 * @property AccountOpenClosedFiscalyear[] $accountOpenClosedFiscalyears
 * @property AccountPartnerBalance[] $accountPartnerBalances
 * @property AccountSequenceFiscalyear[] $accountSequenceFiscalyears
 * @property AccountPrintJournal[] $accountPrintJournals
 * @property AccountReportGeneralLedger[] $accountReportGeneralLedgers
 * @property AccountingReport[] $accountingReports
 * @property AccountingReport[] $accountingReports1
 * @property AccountVatDeclaration[] $accountVatDeclarations
 * @property ResUsers $writeU
 * @property AccountJournalPeriod $endJournalPeriod
 * @property ResUsers $createU
 * @property ResCompany $company
 */
class AccountFiscalyear extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_fiscalyear';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_stop, code, name, date_start, company_id', 'required'),
			array('create_uid, write_uid, end_journal_period_id, company_id', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>6),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, state', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, date_stop, code, name, end_journal_period_id, date_start, company_id, state', 'safe', 'on'=>'search'),
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
			'accountAgedTrialBalances' => array(self::HAS_MANY, 'AccountAgedTrialBalance', 'fiscalyear_id'),
			'accountBalanceReports' => array(self::HAS_MANY, 'AccountBalanceReport', 'fiscalyear_id'),
			'accountCommonAccountReports' => array(self::HAS_MANY, 'AccountCommonAccountReport', 'fiscalyear_id'),
			'accountCentralJournals' => array(self::HAS_MANY, 'AccountCentralJournal', 'fiscalyear_id'),
			'accountCharts' => array(self::HAS_MANY, 'AccountChart', 'fiscalyear'),
			'accountCommonJournalReports' => array(self::HAS_MANY, 'AccountCommonJournalReport', 'fiscalyear_id'),
			'accountCommonPartnerReports' => array(self::HAS_MANY, 'AccountCommonPartnerReport', 'fiscalyear_id'),
			'accountCommonReports' => array(self::HAS_MANY, 'AccountCommonReport', 'fiscalyear_id'),
			'accountFiscalyearCloseStates' => array(self::HAS_MANY, 'AccountFiscalyearCloseState', 'fy_id'),
			'accountPeriods' => array(self::HAS_MANY, 'AccountPeriod', 'fiscalyear_id'),
			'accountGeneralJournals' => array(self::HAS_MANY, 'AccountGeneralJournal', 'fiscalyear_id'),
			'accountFiscalyearCloses' => array(self::HAS_MANY, 'AccountFiscalyearClose', 'fy_id'),
			'accountFiscalyearCloses1' => array(self::HAS_MANY, 'AccountFiscalyearClose', 'fy2_id'),
			'accountPartnerLedgers' => array(self::HAS_MANY, 'AccountPartnerLedger', 'fiscalyear_id'),
			'accountOpenClosedFiscalyears' => array(self::HAS_MANY, 'AccountOpenClosedFiscalyear', 'fyear_id'),
			'accountPartnerBalances' => array(self::HAS_MANY, 'AccountPartnerBalance', 'fiscalyear_id'),
			'accountSequenceFiscalyears' => array(self::HAS_MANY, 'AccountSequenceFiscalyear', 'fiscalyear_id'),
			'accountPrintJournals' => array(self::HAS_MANY, 'AccountPrintJournal', 'fiscalyear_id'),
			'accountReportGeneralLedgers' => array(self::HAS_MANY, 'AccountReportGeneralLedger', 'fiscalyear_id'),
			'accountingReports' => array(self::HAS_MANY, 'AccountingReport', 'fiscalyear_id'),
			'accountingReports1' => array(self::HAS_MANY, 'AccountingReport', 'fiscalyear_id_cmp'),
			'accountVatDeclarations' => array(self::HAS_MANY, 'AccountVatDeclaration', 'fiscalyear_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'endJournalPeriod' => array(self::BELONGS_TO, 'AccountJournalPeriod', 'end_journal_period_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
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
			'date_stop' => 'Date Stop',
			'code' => 'Code',
			'name' => 'Name',
			'end_journal_period_id' => 'End Journal Period',
			'date_start' => 'Date Start',
			'company_id' => 'Company',
			'state' => 'State',
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
		$criteria->compare('date_stop',$this->date_stop,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('end_journal_period_id',$this->end_journal_period_id);
		$criteria->compare('date_start',$this->date_start,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('state',$this->state,true);

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
	 * @return AccountFiscalyear the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
