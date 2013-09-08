<?php

/**
 * This is the model class for table "account_journal".
 *
 * The followings are the available columns in table 'account_journal':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $default_debit_account_id
 * @property string $code
 * @property integer $default_credit_account_id
 * @property integer $loss_account_id
 * @property integer $currency
 * @property integer $internal_account_id
 * @property boolean $allow_date
 * @property integer $sequence_id
 * @property boolean $update_posted
 * @property integer $user_id
 * @property string $name
 * @property boolean $cash_control
 * @property boolean $centralisation
 * @property boolean $group_invoice_lines
 * @property boolean $with_last_closing_balance
 * @property integer $company_id
 * @property integer $analytic_journal_id
 * @property integer $profit_account_id
 * @property boolean $entry_posted
 * @property string $type
 *
 * The followings are the available model relations:
 * @property AccountAccountTypeRel[] $accountAccountTypeRels
 * @property AccountAutomaticReconcile[] $accountAutomaticReconciles
 * @property AccountBankStatement[] $accountBankStatements
 * @property AccountBalanceReportJournalRel[] $accountBalanceReportJournalRels
 * @property AccountCommonAccountReportAccountJournalRel[] $accountCommonAccountReportAccountJournalRels
 * @property AccountCommonJournalReportAccountJournalRel[] $accountCommonJournalReportAccountJournalRels
 * @property AccountCommonPartnerReportAccountJournalRel[] $accountCommonPartnerReportAccountJournalRels
 * @property AccountCommonReportAccountJournalRel[] $accountCommonReportAccountJournalRels
 * @property AccountConfigSettings[] $accountConfigSettings
 * @property AccountConfigSettings[] $accountConfigSettings1
 * @property AccountConfigSettings[] $accountConfigSettings2
 * @property AccountConfigSettings[] $accountConfigSettings3
 * @property AccountMove[] $accountMoves
 * @property AccountInvoice[] $accountInvoices
 * @property AccountFiscalyearClose[] $accountFiscalyearCloses
 * @property AccountGeneralJournalJournalRel[] $accountGeneralJournalJournalRels
 * @property AccountInvoiceRefund[] $accountInvoiceRefunds
 * @property AccountJournalPeriod[] $accountJournalPeriods
 * @property AccountJournalCashboxLine[] $accountJournalCashboxLines
 * @property AccountModel[] $accountModels
 * @property AccountJournalAccountVatDeclarationRel[] $accountJournalAccountVatDeclarationRels
 * @property AccountJournalAccountingReportRel[] $accountJournalAccountingReportRels
 * @property AccountJournalGroupRel[] $accountJournalGroupRels
 * @property AccountJournalTypeRel[] $accountJournalTypeRels
 * @property AccountMoveBankReconcile[] $accountMoveBankReconciles
 * @property AccountMoveLineReconcileWriteoff[] $accountMoveLineReconcileWriteoffs
 * @property PurchaseOrder[] $purchaseOrders
 * @property ResPartnerBank[] $resPartnerBanks
 * @property StockChangeStandardPrice[] $stockChangeStandardPrices
 * @property ValidateAccountMove[] $validateAccountMoves
 * @property AccountPartnerBalanceJournalRel[] $accountPartnerBalanceJournalRels
 * @property AccountPartnerLedgerJournalRel[] $accountPartnerLedgerJournalRels
 * @property AccountCentralJournalJournalRel[] $accountCentralJournalJournalRels
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property IrSequence $sequence
 * @property AccountAccount $profitAccount
 * @property AccountAccount $lossAccount
 * @property AccountAccount $internalAccount
 * @property AccountAccount $defaultDebitAccount
 * @property AccountAccount $defaultCreditAccount
 * @property ResCurrency $currency0
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property AccountAnalyticJournal $analyticJournal
 * @property AccountReportGeneralLedgerJournalRel[] $accountReportGeneralLedgerJournalRels
 * @property AccountVoucher[] $accountVouchers
 * @property AccountAgedTrialBalanceJournalRel[] $accountAgedTrialBalanceJournalRels
 * @property AccountPrintJournalJournalRel[] $accountPrintJournalJournalRels
 */
class AccountJournal extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_journal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, sequence_id, name, company_id, type', 'required'),
			array('create_uid, write_uid, default_debit_account_id, default_credit_account_id, loss_account_id, currency, internal_account_id, sequence_id, user_id, company_id, analytic_journal_id, profit_account_id', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>5),
			array('name', 'length', 'max'=>64),
			array('type', 'length', 'max'=>32),
			array('create_date, write_date, allow_date, update_posted, cash_control, centralisation, group_invoice_lines, with_last_closing_balance, entry_posted', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, default_debit_account_id, code, default_credit_account_id, loss_account_id, currency, internal_account_id, allow_date, sequence_id, update_posted, user_id, name, cash_control, centralisation, group_invoice_lines, with_last_closing_balance, company_id, analytic_journal_id, profit_account_id, entry_posted, type', 'safe', 'on'=>'search'),
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
			'accountAccountTypeRels' => array(self::HAS_MANY, 'AccountAccountTypeRel', 'journal_id'),
			'accountAutomaticReconciles' => array(self::HAS_MANY, 'AccountAutomaticReconcile', 'journal_id'),
			'accountBankStatements' => array(self::HAS_MANY, 'AccountBankStatement', 'journal_id'),
			'accountBalanceReportJournalRels' => array(self::HAS_MANY, 'AccountBalanceReportJournalRel', 'journal_id'),
			'accountCommonAccountReportAccountJournalRels' => array(self::HAS_MANY, 'AccountCommonAccountReportAccountJournalRel', 'account_journal_id'),
			'accountCommonJournalReportAccountJournalRels' => array(self::HAS_MANY, 'AccountCommonJournalReportAccountJournalRel', 'account_journal_id'),
			'accountCommonPartnerReportAccountJournalRels' => array(self::HAS_MANY, 'AccountCommonPartnerReportAccountJournalRel', 'account_journal_id'),
			'accountCommonReportAccountJournalRels' => array(self::HAS_MANY, 'AccountCommonReportAccountJournalRel', 'account_journal_id'),
			'accountConfigSettings' => array(self::HAS_MANY, 'AccountConfigSettings', 'sale_refund_journal_id'),
			'accountConfigSettings1' => array(self::HAS_MANY, 'AccountConfigSettings', 'sale_journal_id'),
			'accountConfigSettings2' => array(self::HAS_MANY, 'AccountConfigSettings', 'purchase_refund_journal_id'),
			'accountConfigSettings3' => array(self::HAS_MANY, 'AccountConfigSettings', 'purchase_journal_id'),
			'accountMoves' => array(self::HAS_MANY, 'AccountMove', 'journal_id'),
			'accountInvoices' => array(self::HAS_MANY, 'AccountInvoice', 'journal_id'),
			'accountFiscalyearCloses' => array(self::HAS_MANY, 'AccountFiscalyearClose', 'journal_id'),
			'accountGeneralJournalJournalRels' => array(self::HAS_MANY, 'AccountGeneralJournalJournalRel', 'journal_id'),
			'accountInvoiceRefunds' => array(self::HAS_MANY, 'AccountInvoiceRefund', 'journal_id'),
			'accountJournalPeriods' => array(self::HAS_MANY, 'AccountJournalPeriod', 'journal_id'),
			'accountJournalCashboxLines' => array(self::HAS_MANY, 'AccountJournalCashboxLine', 'journal_id'),
			'accountModels' => array(self::HAS_MANY, 'AccountModel', 'journal_id'),
			'accountJournalAccountVatDeclarationRels' => array(self::HAS_MANY, 'AccountJournalAccountVatDeclarationRel', 'account_journal_id'),
			'accountJournalAccountingReportRels' => array(self::HAS_MANY, 'AccountJournalAccountingReportRel', 'account_journal_id'),
			'accountJournalGroupRels' => array(self::HAS_MANY, 'AccountJournalGroupRel', 'journal_id'),
			'accountJournalTypeRels' => array(self::HAS_MANY, 'AccountJournalTypeRel', 'journal_id'),
			'accountMoveBankReconciles' => array(self::HAS_MANY, 'AccountMoveBankReconcile', 'journal_id'),
			'accountMoveLineReconcileWriteoffs' => array(self::HAS_MANY, 'AccountMoveLineReconcileWriteoff', 'journal_id'),
			'purchaseOrders' => array(self::HAS_MANY, 'PurchaseOrder', 'journal_id'),
			'resPartnerBanks' => array(self::HAS_MANY, 'ResPartnerBank', 'journal_id'),
			'stockChangeStandardPrices' => array(self::HAS_MANY, 'StockChangeStandardPrice', 'stock_journal'),
			'validateAccountMoves' => array(self::HAS_MANY, 'ValidateAccountMove', 'journal_id'),
			'accountPartnerBalanceJournalRels' => array(self::HAS_MANY, 'AccountPartnerBalanceJournalRel', 'journal_id'),
			'accountPartnerLedgerJournalRels' => array(self::HAS_MANY, 'AccountPartnerLedgerJournalRel', 'journal_id'),
			'accountCentralJournalJournalRels' => array(self::HAS_MANY, 'AccountCentralJournalJournalRel', 'journal_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'user' => array(self::BELONGS_TO, 'ResUsers', 'user_id'),
			'sequence' => array(self::BELONGS_TO, 'IrSequence', 'sequence_id'),
			'profitAccount' => array(self::BELONGS_TO, 'AccountAccount', 'profit_account_id'),
			'lossAccount' => array(self::BELONGS_TO, 'AccountAccount', 'loss_account_id'),
			'internalAccount' => array(self::BELONGS_TO, 'AccountAccount', 'internal_account_id'),
			'defaultDebitAccount' => array(self::BELONGS_TO, 'AccountAccount', 'default_debit_account_id'),
			'defaultCreditAccount' => array(self::BELONGS_TO, 'AccountAccount', 'default_credit_account_id'),
			'currency0' => array(self::BELONGS_TO, 'ResCurrency', 'currency'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'analyticJournal' => array(self::BELONGS_TO, 'AccountAnalyticJournal', 'analytic_journal_id'),
			'accountReportGeneralLedgerJournalRels' => array(self::HAS_MANY, 'AccountReportGeneralLedgerJournalRel', 'journal_id'),
			'accountVouchers' => array(self::HAS_MANY, 'AccountVoucher', 'journal_id'),
			'accountAgedTrialBalanceJournalRels' => array(self::HAS_MANY, 'AccountAgedTrialBalanceJournalRel', 'journal_id'),
			'accountPrintJournalJournalRels' => array(self::HAS_MANY, 'AccountPrintJournalJournalRel', 'journal_id'),
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
			'default_debit_account_id' => 'Default Debit Account',
			'code' => 'Code',
			'default_credit_account_id' => 'Default Credit Account',
			'loss_account_id' => 'Loss Account',
			'currency' => 'Currency',
			'internal_account_id' => 'Internal Account',
			'allow_date' => 'Allow Date',
			'sequence_id' => 'Sequence',
			'update_posted' => 'Update Posted',
			'user_id' => 'User',
			'name' => 'Name',
			'cash_control' => 'Cash Control',
			'centralisation' => 'Centralisation',
			'group_invoice_lines' => 'Group Invoice Lines',
			'with_last_closing_balance' => 'With Last Closing Balance',
			'company_id' => 'Company',
			'analytic_journal_id' => 'Analytic Journal',
			'profit_account_id' => 'Profit Account',
			'entry_posted' => 'Entry Posted',
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
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('default_debit_account_id',$this->default_debit_account_id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('default_credit_account_id',$this->default_credit_account_id);
		$criteria->compare('loss_account_id',$this->loss_account_id);
		$criteria->compare('currency',$this->currency);
		$criteria->compare('internal_account_id',$this->internal_account_id);
		$criteria->compare('allow_date',$this->allow_date);
		$criteria->compare('sequence_id',$this->sequence_id);
		$criteria->compare('update_posted',$this->update_posted);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('cash_control',$this->cash_control);
		$criteria->compare('centralisation',$this->centralisation);
		$criteria->compare('group_invoice_lines',$this->group_invoice_lines);
		$criteria->compare('with_last_closing_balance',$this->with_last_closing_balance);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('analytic_journal_id',$this->analytic_journal_id);
		$criteria->compare('profit_account_id',$this->profit_account_id);
		$criteria->compare('entry_posted',$this->entry_posted);
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
	 * @return AccountJournal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
