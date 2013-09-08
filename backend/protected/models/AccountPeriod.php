<?php

/**
 * This is the model class for table "account_period".
 *
 * The followings are the available columns in table 'account_period':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $date_stop
 * @property string $code
 * @property string $name
 * @property string $date_start
 * @property integer $fiscalyear_id
 * @property integer $company_id
 * @property string $state
 * @property boolean $special
 *
 * The followings are the available model relations:
 * @property AccountAutomaticReconcile[] $accountAutomaticReconciles
 * @property AccountAgedTrialBalance[] $accountAgedTrialBalances
 * @property AccountAgedTrialBalance[] $accountAgedTrialBalances1
 * @property AccountBankStatement[] $accountBankStatements
 * @property AccountBalanceReport[] $accountBalanceReports
 * @property AccountBalanceReport[] $accountBalanceReports1
 * @property AccountCommonAccountReport[] $accountCommonAccountReports
 * @property AccountCommonAccountReport[] $accountCommonAccountReports1
 * @property AccountCentralJournal[] $accountCentralJournals
 * @property AccountCentralJournal[] $accountCentralJournals1
 * @property AccountChart[] $accountCharts
 * @property AccountChart[] $accountCharts1
 * @property AccountMove[] $accountMoves
 * @property AccountCommonJournalReport[] $accountCommonJournalReports
 * @property AccountCommonJournalReport[] $accountCommonJournalReports1
 * @property AccountCommonPartnerReport[] $accountCommonPartnerReports
 * @property AccountCommonPartnerReport[] $accountCommonPartnerReports1
 * @property AccountCommonReport[] $accountCommonReports
 * @property AccountCommonReport[] $accountCommonReports1
 * @property ResUsers $writeU
 * @property AccountFiscalyear $fiscalyear
 * @property ResUsers $createU
 * @property AccountGeneralJournal[] $accountGeneralJournals
 * @property AccountGeneralJournal[] $accountGeneralJournals1
 * @property AccountInvoice[] $accountInvoices
 * @property AccountFiscalyearClose[] $accountFiscalyearCloses
 * @property AccountInvoiceRefund[] $accountInvoiceRefunds
 * @property AccountJournalPeriod[] $accountJournalPeriods
 * @property AccountPartnerLedger[] $accountPartnerLedgers
 * @property AccountPartnerLedger[] $accountPartnerLedgers1
 * @property AccountPartnerBalance[] $accountPartnerBalances
 * @property AccountPartnerBalance[] $accountPartnerBalances1
 * @property AccountPrintJournal[] $accountPrintJournals
 * @property AccountPrintJournal[] $accountPrintJournals1
 * @property AccountTaxChart[] $accountTaxCharts
 * @property AccountReportGeneralLedger[] $accountReportGeneralLedgers
 * @property AccountReportGeneralLedger[] $accountReportGeneralLedgers1
 * @property AccountingReport[] $accountingReports
 * @property AccountingReport[] $accountingReports1
 * @property AccountingReport[] $accountingReports2
 * @property AccountingReport[] $accountingReports3
 * @property AccountVatDeclaration[] $accountVatDeclarations
 * @property AccountVatDeclaration[] $accountVatDeclarations1
 * @property ValidateAccountMove[] $validateAccountMoves
 * @property AccountVoucher[] $accountVouchers
 */
class AccountPeriod extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_period';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_stop, name, date_start, fiscalyear_id', 'required'),
			array('create_uid, write_uid, fiscalyear_id, company_id', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>12),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, state, special', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, date_stop, code, name, date_start, fiscalyear_id, company_id, state, special', 'safe', 'on'=>'search'),
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
			'accountAutomaticReconciles' => array(self::HAS_MANY, 'AccountAutomaticReconcile', 'period_id'),
			'accountAgedTrialBalances' => array(self::HAS_MANY, 'AccountAgedTrialBalance', 'period_to'),
			'accountAgedTrialBalances1' => array(self::HAS_MANY, 'AccountAgedTrialBalance', 'period_from'),
			'accountBankStatements' => array(self::HAS_MANY, 'AccountBankStatement', 'period_id'),
			'accountBalanceReports' => array(self::HAS_MANY, 'AccountBalanceReport', 'period_to'),
			'accountBalanceReports1' => array(self::HAS_MANY, 'AccountBalanceReport', 'period_from'),
			'accountCommonAccountReports' => array(self::HAS_MANY, 'AccountCommonAccountReport', 'period_to'),
			'accountCommonAccountReports1' => array(self::HAS_MANY, 'AccountCommonAccountReport', 'period_from'),
			'accountCentralJournals' => array(self::HAS_MANY, 'AccountCentralJournal', 'period_to'),
			'accountCentralJournals1' => array(self::HAS_MANY, 'AccountCentralJournal', 'period_from'),
			'accountCharts' => array(self::HAS_MANY, 'AccountChart', 'period_to'),
			'accountCharts1' => array(self::HAS_MANY, 'AccountChart', 'period_from'),
			'accountMoves' => array(self::HAS_MANY, 'AccountMove', 'period_id'),
			'accountCommonJournalReports' => array(self::HAS_MANY, 'AccountCommonJournalReport', 'period_to'),
			'accountCommonJournalReports1' => array(self::HAS_MANY, 'AccountCommonJournalReport', 'period_from'),
			'accountCommonPartnerReports' => array(self::HAS_MANY, 'AccountCommonPartnerReport', 'period_to'),
			'accountCommonPartnerReports1' => array(self::HAS_MANY, 'AccountCommonPartnerReport', 'period_from'),
			'accountCommonReports' => array(self::HAS_MANY, 'AccountCommonReport', 'period_to'),
			'accountCommonReports1' => array(self::HAS_MANY, 'AccountCommonReport', 'period_from'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'fiscalyear' => array(self::BELONGS_TO, 'AccountFiscalyear', 'fiscalyear_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'accountGeneralJournals' => array(self::HAS_MANY, 'AccountGeneralJournal', 'period_to'),
			'accountGeneralJournals1' => array(self::HAS_MANY, 'AccountGeneralJournal', 'period_from'),
			'accountInvoices' => array(self::HAS_MANY, 'AccountInvoice', 'period_id'),
			'accountFiscalyearCloses' => array(self::HAS_MANY, 'AccountFiscalyearClose', 'period_id'),
			'accountInvoiceRefunds' => array(self::HAS_MANY, 'AccountInvoiceRefund', 'period'),
			'accountJournalPeriods' => array(self::HAS_MANY, 'AccountJournalPeriod', 'period_id'),
			'accountPartnerLedgers' => array(self::HAS_MANY, 'AccountPartnerLedger', 'period_to'),
			'accountPartnerLedgers1' => array(self::HAS_MANY, 'AccountPartnerLedger', 'period_from'),
			'accountPartnerBalances' => array(self::HAS_MANY, 'AccountPartnerBalance', 'period_to'),
			'accountPartnerBalances1' => array(self::HAS_MANY, 'AccountPartnerBalance', 'period_from'),
			'accountPrintJournals' => array(self::HAS_MANY, 'AccountPrintJournal', 'period_to'),
			'accountPrintJournals1' => array(self::HAS_MANY, 'AccountPrintJournal', 'period_from'),
			'accountTaxCharts' => array(self::HAS_MANY, 'AccountTaxChart', 'period_id'),
			'accountReportGeneralLedgers' => array(self::HAS_MANY, 'AccountReportGeneralLedger', 'period_to'),
			'accountReportGeneralLedgers1' => array(self::HAS_MANY, 'AccountReportGeneralLedger', 'period_from'),
			'accountingReports' => array(self::HAS_MANY, 'AccountingReport', 'period_to'),
			'accountingReports1' => array(self::HAS_MANY, 'AccountingReport', 'period_to_cmp'),
			'accountingReports2' => array(self::HAS_MANY, 'AccountingReport', 'period_from'),
			'accountingReports3' => array(self::HAS_MANY, 'AccountingReport', 'period_from_cmp'),
			'accountVatDeclarations' => array(self::HAS_MANY, 'AccountVatDeclaration', 'period_to'),
			'accountVatDeclarations1' => array(self::HAS_MANY, 'AccountVatDeclaration', 'period_from'),
			'validateAccountMoves' => array(self::HAS_MANY, 'ValidateAccountMove', 'period_id'),
			'accountVouchers' => array(self::HAS_MANY, 'AccountVoucher', 'period_id'),
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
			'date_start' => 'Date Start',
			'fiscalyear_id' => 'Fiscalyear',
			'company_id' => 'Company',
			'state' => 'State',
			'special' => 'Special',
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
		$criteria->compare('date_start',$this->date_start,true);
		$criteria->compare('fiscalyear_id',$this->fiscalyear_id);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('special',$this->special);

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
	 * @return AccountPeriod the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
