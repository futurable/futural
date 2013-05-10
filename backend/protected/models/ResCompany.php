<?php

/**
 * This is the model class for table "res_company".
 *
 * The followings are the available columns in table 'res_company':
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property integer $partner_id
 * @property integer $currency_id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $rml_footer
 * @property string $rml_header
 * @property string $paper_format
 * @property string $logo_web
 * @property string $rml_header2
 * @property string $rml_header3
 * @property string $rml_header1
 * @property string $account_no
 * @property string $company_registry
 * @property boolean $custom_footer
 * @property boolean $expects_chart_of_accounts
 * @property string $paypal_account
 * @property string $overdue_msg
 * @property string $tax_calculation_rounding_method
 * @property integer $expense_currency_exchange_account_id
 * @property integer $income_currency_exchange_account_id
 *
 * The followings are the available model relations:
 * @property IrValues[] $irValues
 * @property ResourceCalendar[] $resourceCalendars
 * @property ResourceResource[] $resourceResources
 * @property IrDefault[] $irDefaults
 * @property ResCompanyUsersRel[] $resCompanyUsersRels
 * @property IrProperty[] $irProperties
 * @property ResPartnerBank[] $resPartnerBanks
 * @property ResCurrency[] $resCurrencies
 * @property MultiCompanyDefault[] $multiCompanyDefaults
 * @property MultiCompanyDefault[] $multiCompanyDefaults1
 * @property IrSequence[] $irSequences
 * @property IrAttachment[] $irAttachments
 * @property ResPartner[] $resPartners
 * @property CrmPhonecall[] $crmPhonecalls
 * @property CrmLead[] $crmLeads
 * @property PortalCrmCrmContactUsResCompanyRel[] $portalCrmCrmContactUsResCompanyRels
 * @property AccountAnalyticAccount[] $accountAnalyticAccounts
 * @property PortalCrmCrmContactUs[] $portalCrmCrmContactUses
 * @property ProductPricelist[] $productPricelists
 * @property ProductSupplierinfo[] $productSupplierinfos
 * @property ProductTemplate[] $productTemplates
 * @property AccountAnalyticJournal[] $accountAnalyticJournals
 * @property AccountInstaller[] $accountInstallers
 * @property ResUsers[] $resUsers
 * @property AccountFiscalPosition[] $accountFiscalPositions
 * @property AccountAccount $incomeCurrencyExchangeAccount
 * @property AccountAccount $expenseCurrencyExchangeAccount
 * @property ResPartner $partner
 * @property ResCurrency $currency
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property ResCompany $parent
 * @property ResCompany[] $resCompanies
 * @property AccountTax[] $accountTaxes
 * @property AccountTaxCode[] $accountTaxCodes
 * @property AccountFiscalyear[] $accountFiscalyears
 * @property AccountJournal[] $accountJournals
 * @property AccountAccount[] $accountAccounts
 * @property WizardMultiChartsAccounts[] $wizardMultiChartsAccounts
 * @property AccountInvoice[] $accountInvoices
 * @property AccountVoucher[] $accountVouchers
 * @property AccountConfigSettings[] $accountConfigSettings
 */
class ResCompany extends ActiveRecord
{
        public function getDbConnection(){
            return self::getOpenerpDbConnection();
        }
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
                return 'res_company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, partner_id, currency_id, rml_header, paper_format, rml_header2, rml_header3', 'required'),
			array('parent_id, partner_id, currency_id, create_uid, write_uid, expense_currency_exchange_account_id, income_currency_exchange_account_id', 'numerical', 'integerOnly'=>true),
			array('name, paypal_account', 'length', 'max'=>128),
			array('rml_header1', 'length', 'max'=>200),
			array('account_no, company_registry', 'length', 'max'=>64),
			array('create_date, write_date, rml_footer, logo_web, custom_footer, expects_chart_of_accounts, overdue_msg, tax_calculation_rounding_method', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, parent_id, partner_id, currency_id, create_uid, create_date, write_date, write_uid, rml_footer, rml_header, paper_format, logo_web, rml_header2, rml_header3, rml_header1, account_no, company_registry, custom_footer, expects_chart_of_accounts, paypal_account, overdue_msg, tax_calculation_rounding_method, expense_currency_exchange_account_id, income_currency_exchange_account_id', 'safe', 'on'=>'search'),
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
			'irValues' => array(self::HAS_MANY, 'IrValues', 'company_id'),
			'resourceCalendars' => array(self::HAS_MANY, 'ResourceCalendar', 'company_id'),
			'resourceResources' => array(self::HAS_MANY, 'ResourceResource', 'company_id'),
			'irDefaults' => array(self::HAS_MANY, 'IrDefault', 'company_id'),
			'resCompanyUsersRels' => array(self::HAS_MANY, 'ResCompanyUsersRel', 'cid'),
			'irProperties' => array(self::HAS_MANY, 'IrProperty', 'company_id'),
			'resPartnerBanks' => array(self::HAS_MANY, 'ResPartnerBank', 'company_id'),
			'resCurrencies' => array(self::HAS_MANY, 'ResCurrency', 'company_id'),
			'multiCompanyDefaults' => array(self::HAS_MANY, 'MultiCompanyDefault', 'company_dest_id'),
			'multiCompanyDefaults1' => array(self::HAS_MANY, 'MultiCompanyDefault', 'company_id'),
			'irSequences' => array(self::HAS_MANY, 'IrSequence', 'company_id'),
			'irAttachments' => array(self::HAS_MANY, 'IrAttachment', 'company_id'),
			'resPartners' => array(self::HAS_MANY, 'ResPartner', 'company_id'),
			'crmPhonecalls' => array(self::HAS_MANY, 'CrmPhonecall', 'company_id'),
			'crmLeads' => array(self::HAS_MANY, 'CrmLead', 'company_id'),
			'portalCrmCrmContactUsResCompanyRels' => array(self::HAS_MANY, 'PortalCrmCrmContactUsResCompanyRel', 'res_company_id'),
			'accountAnalyticAccounts' => array(self::HAS_MANY, 'AccountAnalyticAccount', 'company_id'),
			'portalCrmCrmContactUses' => array(self::HAS_MANY, 'PortalCrmCrmContactUs', 'company_id'),
			'productPricelists' => array(self::HAS_MANY, 'ProductPricelist', 'company_id'),
			'productSupplierinfos' => array(self::HAS_MANY, 'ProductSupplierinfo', 'company_id'),
			'productTemplates' => array(self::HAS_MANY, 'ProductTemplate', 'company_id'),
			'accountAnalyticJournals' => array(self::HAS_MANY, 'AccountAnalyticJournal', 'company_id'),
			'accountInstallers' => array(self::HAS_MANY, 'AccountInstaller', 'company_id'),
			'resUsers' => array(self::HAS_MANY, 'ResUsers', 'company_id'),
			'accountFiscalPositions' => array(self::HAS_MANY, 'AccountFiscalPosition', 'company_id'),
			'incomeCurrencyExchangeAccount' => array(self::BELONGS_TO, 'AccountAccount', 'income_currency_exchange_account_id'),
			'expenseCurrencyExchangeAccount' => array(self::BELONGS_TO, 'AccountAccount', 'expense_currency_exchange_account_id'),
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'currency' => array(self::BELONGS_TO, 'ResCurrency', 'currency_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'parent' => array(self::BELONGS_TO, 'ResCompany', 'parent_id'),
			'resCompanies' => array(self::HAS_MANY, 'ResCompany', 'parent_id'),
			'accountTaxes' => array(self::HAS_MANY, 'AccountTax', 'company_id'),
			'accountTaxCodes' => array(self::HAS_MANY, 'AccountTaxCode', 'company_id'),
			'accountFiscalyears' => array(self::HAS_MANY, 'AccountFiscalyear', 'company_id'),
			'accountJournals' => array(self::HAS_MANY, 'AccountJournal', 'company_id'),
			'accountAccounts' => array(self::HAS_MANY, 'AccountAccount', 'company_id'),
			'wizardMultiChartsAccounts' => array(self::HAS_MANY, 'WizardMultiChartsAccounts', 'company_id'),
			'accountInvoices' => array(self::HAS_MANY, 'AccountInvoice', 'company_id'),
			'accountVouchers' => array(self::HAS_MANY, 'AccountVoucher', 'company_id'),
			'accountConfigSettings' => array(self::HAS_MANY, 'AccountConfigSettings', 'company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'parent_id' => 'Parent',
			'partner_id' => 'Partner',
			'currency_id' => 'Currency',
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'rml_footer' => 'Rml Footer',
			'rml_header' => 'Rml Header',
			'paper_format' => 'Paper Format',
			'logo_web' => 'Logo Web',
			'rml_header2' => 'Rml Header2',
			'rml_header3' => 'Rml Header3',
			'rml_header1' => 'Rml Header1',
			'account_no' => 'Account No',
			'company_registry' => 'Company Registry',
			'custom_footer' => 'Custom Footer',
			'expects_chart_of_accounts' => 'Expects Chart Of Accounts',
			'paypal_account' => 'Paypal Account',
			'overdue_msg' => 'Overdue Msg',
			'tax_calculation_rounding_method' => 'Tax Calculation Rounding Method',
			'expense_currency_exchange_account_id' => 'Expense Currency Exchange Account',
			'income_currency_exchange_account_id' => 'Income Currency Exchange Account',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('rml_footer',$this->rml_footer,true);
		$criteria->compare('rml_header',$this->rml_header,true);
		$criteria->compare('paper_format',$this->paper_format,true);
		$criteria->compare('logo_web',$this->logo_web,true);
		$criteria->compare('rml_header2',$this->rml_header2,true);
		$criteria->compare('rml_header3',$this->rml_header3,true);
		$criteria->compare('rml_header1',$this->rml_header1,true);
		$criteria->compare('account_no',$this->account_no,true);
		$criteria->compare('company_registry',$this->company_registry,true);
		$criteria->compare('custom_footer',$this->custom_footer);
		$criteria->compare('expects_chart_of_accounts',$this->expects_chart_of_accounts);
		$criteria->compare('paypal_account',$this->paypal_account,true);
		$criteria->compare('overdue_msg',$this->overdue_msg,true);
		$criteria->compare('tax_calculation_rounding_method',$this->tax_calculation_rounding_method,true);
		$criteria->compare('expense_currency_exchange_account_id',$this->expense_currency_exchange_account_id);
		$criteria->compare('income_currency_exchange_account_id',$this->income_currency_exchange_account_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ResCompany the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
