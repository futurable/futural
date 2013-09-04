<?php

/**
 * This is the model class for table "account_account".
 *
 * The followings are the available columns in table 'account_account':
 * @property integer $id
 * @property integer $parent_left
 * @property integer $parent_right
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $code
 * @property boolean $reconcile
 * @property integer $currency_id
 * @property integer $user_type
 * @property boolean $active
 * @property string $name
 * @property integer $level
 * @property integer $company_id
 * @property string $shortcut
 * @property string $note
 * @property integer $parent_id
 * @property string $currency_mode
 * @property string $type
 *
 * The followings are the available model relations:
 * @property AccountAddtmplWizard[] $accountAddtmplWizards
 * @property AccountAccountFinancialReport[] $accountAccountFinancialReports
 * @property AccountAccountTaxDefaultRel[] $accountAccountTaxDefaultRels
 * @property AccountAccountTypeRel[] $accountAccountTypeRels
 * @property AccountAutomaticReconcile[] $accountAutomaticReconciles
 * @property AccountAnalyticLine[] $accountAnalyticLines
 * @property AccountAgedTrialBalance[] $accountAgedTrialBalances
 * @property AccountBalanceReport[] $accountBalanceReports
 * @property AccountCommonAccountReport[] $accountCommonAccountReports
 * @property AccountCentralJournal[] $accountCentralJournals
 * @property AccountBankStatementLine[] $accountBankStatementLines
 * @property AccountCommonJournalReport[] $accountCommonJournalReports
 * @property AccountCommonPartnerReport[] $accountCommonPartnerReports
 * @property AccountCommonReport[] $accountCommonReports
 * @property AccountMoveLine[] $accountMoveLines
 * @property AccountGeneralJournal[] $accountGeneralJournals
 * @property AccountInvoice[] $accountInvoices
 * @property AccountInvoiceTax[] $accountInvoiceTaxes
 * @property AccountMoveLineReconcileSelect[] $accountMoveLineReconcileSelects
 * @property AccountPartnerLedger[] $accountPartnerLedgers
 * @property AccountModelLine[] $accountModelLines
 * @property AccountMoveLineReconcileWriteoff[] $accountMoveLineReconcileWriteoffs
 * @property AccountMoveLineUnreconcileSelect[] $accountMoveLineUnreconcileSelects
 * @property AccountPartnerBalance[] $accountPartnerBalances
 * @property AccountPrintJournal[] $accountPrintJournals
 * @property AccountReportGeneralLedger[] $accountReportGeneralLedgers
 * @property AccountingReport[] $accountingReports
 * @property AccountVoucherLine[] $accountVoucherLines
 * @property AccountVatDeclaration[] $accountVatDeclarations
 * @property MrpWorkcenter[] $mrpWorkcenters
 * @property ReconcileAccountRel[] $reconcileAccountRels
 * @property StockChangeStandardPrice[] $stockChangeStandardPrices
 * @property StockChangeStandardPrice[] $stockChangeStandardPrices1
 * @property AccountInvoiceLine[] $accountInvoiceLines
 * @property AccountAccountConsolRel[] $accountAccountConsolRels
 * @property AccountAccountConsolRel[] $accountAccountConsolRels1
 * @property AccountTax[] $accountTaxes
 * @property AccountTax[] $accountTaxes1
 * @property AccountJournal[] $accountJournals
 * @property AccountJournal[] $accountJournals1
 * @property AccountJournal[] $accountJournals2
 * @property AccountJournal[] $accountJournals3
 * @property AccountJournal[] $accountJournals4
 * @property ResCompany[] $resCompanies
 * @property ResCompany[] $resCompanies1
 * @property AccountFiscalPositionAccount[] $accountFiscalPositionAccounts
 * @property AccountFiscalPositionAccount[] $accountFiscalPositionAccounts1
 * @property AccountVoucher[] $accountVouchers
 * @property AccountVoucher[] $accountVouchers1
 * @property ResUsers $writeU
 * @property AccountAccountType $userType
 * @property AccountAccount $parent
 * @property AccountAccount[] $accountAccounts
 * @property ResCurrency $currency
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property StockLocation[] $stockLocations
 * @property StockLocation[] $stockLocations1
 */
class AccountAccount extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_account';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, user_type, name, company_id, currency_mode, type', 'required'),
			array('parent_left, parent_right, create_uid, write_uid, currency_id, user_type, level, company_id, parent_id', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>64),
			array('name', 'length', 'max'=>256),
			array('shortcut', 'length', 'max'=>12),
			array('create_date, write_date, reconcile, active, note', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_left, parent_right, create_uid, create_date, write_date, write_uid, code, reconcile, currency_id, user_type, active, name, level, company_id, shortcut, note, parent_id, currency_mode, type', 'safe', 'on'=>'search'),
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
			'accountAddtmplWizards' => array(self::HAS_MANY, 'AccountAddtmplWizard', 'cparent_id'),
			'accountAccountFinancialReports' => array(self::HAS_MANY, 'AccountAccountFinancialReport', 'account_id'),
			'accountAccountTaxDefaultRels' => array(self::HAS_MANY, 'AccountAccountTaxDefaultRel', 'account_id'),
			'accountAccountTypeRels' => array(self::HAS_MANY, 'AccountAccountTypeRel', 'account_id'),
			'accountAutomaticReconciles' => array(self::HAS_MANY, 'AccountAutomaticReconcile', 'writeoff_acc_id'),
			'accountAnalyticLines' => array(self::HAS_MANY, 'AccountAnalyticLine', 'general_account_id'),
			'accountAgedTrialBalances' => array(self::HAS_MANY, 'AccountAgedTrialBalance', 'chart_account_id'),
			'accountBalanceReports' => array(self::HAS_MANY, 'AccountBalanceReport', 'chart_account_id'),
			'accountCommonAccountReports' => array(self::HAS_MANY, 'AccountCommonAccountReport', 'chart_account_id'),
			'accountCentralJournals' => array(self::HAS_MANY, 'AccountCentralJournal', 'chart_account_id'),
			'accountBankStatementLines' => array(self::HAS_MANY, 'AccountBankStatementLine', 'account_id'),
			'accountCommonJournalReports' => array(self::HAS_MANY, 'AccountCommonJournalReport', 'chart_account_id'),
			'accountCommonPartnerReports' => array(self::HAS_MANY, 'AccountCommonPartnerReport', 'chart_account_id'),
			'accountCommonReports' => array(self::HAS_MANY, 'AccountCommonReport', 'chart_account_id'),
			'accountMoveLines' => array(self::HAS_MANY, 'AccountMoveLine', 'account_id'),
			'accountGeneralJournals' => array(self::HAS_MANY, 'AccountGeneralJournal', 'chart_account_id'),
			'accountInvoices' => array(self::HAS_MANY, 'AccountInvoice', 'account_id'),
			'accountInvoiceTaxes' => array(self::HAS_MANY, 'AccountInvoiceTax', 'account_id'),
			'accountMoveLineReconcileSelects' => array(self::HAS_MANY, 'AccountMoveLineReconcileSelect', 'account_id'),
			'accountPartnerLedgers' => array(self::HAS_MANY, 'AccountPartnerLedger', 'chart_account_id'),
			'accountModelLines' => array(self::HAS_MANY, 'AccountModelLine', 'account_id'),
			'accountMoveLineReconcileWriteoffs' => array(self::HAS_MANY, 'AccountMoveLineReconcileWriteoff', 'writeoff_acc_id'),
			'accountMoveLineUnreconcileSelects' => array(self::HAS_MANY, 'AccountMoveLineUnreconcileSelect', 'account_id'),
			'accountPartnerBalances' => array(self::HAS_MANY, 'AccountPartnerBalance', 'chart_account_id'),
			'accountPrintJournals' => array(self::HAS_MANY, 'AccountPrintJournal', 'chart_account_id'),
			'accountReportGeneralLedgers' => array(self::HAS_MANY, 'AccountReportGeneralLedger', 'chart_account_id'),
			'accountingReports' => array(self::HAS_MANY, 'AccountingReport', 'chart_account_id'),
			'accountVoucherLines' => array(self::HAS_MANY, 'AccountVoucherLine', 'account_id'),
			'accountVatDeclarations' => array(self::HAS_MANY, 'AccountVatDeclaration', 'chart_account_id'),
			'mrpWorkcenters' => array(self::HAS_MANY, 'MrpWorkcenter', 'costs_general_account_id'),
			'reconcileAccountRels' => array(self::HAS_MANY, 'ReconcileAccountRel', 'account_id'),
			'stockChangeStandardPrices' => array(self::HAS_MANY, 'StockChangeStandardPrice', 'stock_account_output'),
			'stockChangeStandardPrices1' => array(self::HAS_MANY, 'StockChangeStandardPrice', 'stock_account_input'),
			'accountInvoiceLines' => array(self::HAS_MANY, 'AccountInvoiceLine', 'account_id'),
			'accountAccountConsolRels' => array(self::HAS_MANY, 'AccountAccountConsolRel', 'parent_id'),
			'accountAccountConsolRels1' => array(self::HAS_MANY, 'AccountAccountConsolRel', 'child_id'),
			'accountTaxes' => array(self::HAS_MANY, 'AccountTax', 'account_paid_id'),
			'accountTaxes1' => array(self::HAS_MANY, 'AccountTax', 'account_collected_id'),
			'accountJournals' => array(self::HAS_MANY, 'AccountJournal', 'profit_account_id'),
			'accountJournals1' => array(self::HAS_MANY, 'AccountJournal', 'loss_account_id'),
			'accountJournals2' => array(self::HAS_MANY, 'AccountJournal', 'internal_account_id'),
			'accountJournals3' => array(self::HAS_MANY, 'AccountJournal', 'default_debit_account_id'),
			'accountJournals4' => array(self::HAS_MANY, 'AccountJournal', 'default_credit_account_id'),
			'resCompanies' => array(self::HAS_MANY, 'ResCompany', 'income_currency_exchange_account_id'),
			'resCompanies1' => array(self::HAS_MANY, 'ResCompany', 'expense_currency_exchange_account_id'),
			'accountFiscalPositionAccounts' => array(self::HAS_MANY, 'AccountFiscalPositionAccount', 'account_src_id'),
			'accountFiscalPositionAccounts1' => array(self::HAS_MANY, 'AccountFiscalPositionAccount', 'account_dest_id'),
			'accountVouchers' => array(self::HAS_MANY, 'AccountVoucher', 'writeoff_acc_id'),
			'accountVouchers1' => array(self::HAS_MANY, 'AccountVoucher', 'account_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'userType' => array(self::BELONGS_TO, 'AccountAccountType', 'user_type'),
			'parent' => array(self::BELONGS_TO, 'AccountAccount', 'parent_id'),
			'accountAccounts' => array(self::HAS_MANY, 'AccountAccount', 'parent_id'),
			'currency' => array(self::BELONGS_TO, 'ResCurrency', 'currency_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'stockLocations' => array(self::HAS_MANY, 'StockLocation', 'valuation_out_account_id'),
			'stockLocations1' => array(self::HAS_MANY, 'StockLocation', 'valuation_in_account_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_left' => 'Parent Left',
			'parent_right' => 'Parent Right',
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'code' => 'Code',
			'reconcile' => 'Reconcile',
			'currency_id' => 'Currency',
			'user_type' => 'User Type',
			'active' => 'Active',
			'name' => 'Name',
			'level' => 'Level',
			'company_id' => 'Company',
			'shortcut' => 'Shortcut',
			'note' => 'Note',
			'parent_id' => 'Parent',
			'currency_mode' => 'Currency Mode',
			'type' => 'Type',
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
		$criteria->compare('parent_left',$this->parent_left);
		$criteria->compare('parent_right',$this->parent_right);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('reconcile',$this->reconcile);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('user_type',$this->user_type);
		$criteria->compare('active',$this->active);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('shortcut',$this->shortcut,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('currency_mode',$this->currency_mode,true);
		$criteria->compare('type',$this->type,true);

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
	 * @return AccountAccount the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
