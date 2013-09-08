<?php

/**
 * This is the model class for table "account_config_settings".
 *
 * The followings are the available columns in table 'account_config_settings':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $date_stop
 * @property integer $sale_journal_id
 * @property boolean $module_account_voucher
 * @property boolean $module_account_asset
 * @property string $period
 * @property boolean $module_account_accountant
 * @property boolean $module_account_followup
 * @property integer $purchase_journal_id
 * @property boolean $has_chart_of_accounts
 * @property integer $sale_refund_journal_id
 * @property boolean $complete_tax_set
 * @property boolean $module_account_budget
 * @property string $date_start
 * @property integer $purchase_refund_journal_id
 * @property integer $company_id
 * @property double $sale_tax_rate
 * @property boolean $group_check_supplier_invoice_total
 * @property boolean $module_account_check_writing
 * @property integer $default_purchase_tax
 * @property boolean $has_default_company
 * @property double $purchase_tax_rate
 * @property integer $default_sale_tax
 * @property boolean $has_fiscal_year
 * @property boolean $module_account_payment
 * @property integer $sale_tax
 * @property boolean $group_multi_currency
 * @property integer $purchase_tax
 * @property boolean $group_proforma_invoices
 * @property integer $decimal_precision
 * @property integer $code_digits
 * @property integer $chart_template_id
 * @property boolean $group_analytic_accounting
 * @property boolean $group_analytic_account_for_sales
 * @property boolean $module_sale_analytic_plans
 * @property boolean $module_purchase_analytic_plans
 * @property boolean $group_analytic_account_for_purchases
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property AccountTaxTemplate $saleTax
 * @property AccountJournal $saleRefundJournal
 * @property AccountJournal $saleJournal
 * @property AccountTaxTemplate $purchaseTax
 * @property AccountJournal $purchaseRefundJournal
 * @property AccountJournal $purchaseJournal
 * @property AccountTax $defaultSaleTax
 * @property AccountTax $defaultPurchaseTax
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property AccountChartTemplate $chartTemplate
 */
class AccountConfigSettings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_config_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_stop, period, date_start, company_id', 'required'),
			array('create_uid, write_uid, sale_journal_id, purchase_journal_id, sale_refund_journal_id, purchase_refund_journal_id, company_id, default_purchase_tax, default_sale_tax, sale_tax, purchase_tax, decimal_precision, code_digits, chart_template_id', 'numerical', 'integerOnly'=>true),
			array('sale_tax_rate, purchase_tax_rate', 'numerical'),
			array('create_date, write_date, module_account_voucher, module_account_asset, module_account_accountant, module_account_followup, has_chart_of_accounts, complete_tax_set, module_account_budget, group_check_supplier_invoice_total, module_account_check_writing, has_default_company, has_fiscal_year, module_account_payment, group_multi_currency, group_proforma_invoices, group_analytic_accounting, group_analytic_account_for_sales, module_sale_analytic_plans, module_purchase_analytic_plans, group_analytic_account_for_purchases', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, date_stop, sale_journal_id, module_account_voucher, module_account_asset, period, module_account_accountant, module_account_followup, purchase_journal_id, has_chart_of_accounts, sale_refund_journal_id, complete_tax_set, module_account_budget, date_start, purchase_refund_journal_id, company_id, sale_tax_rate, group_check_supplier_invoice_total, module_account_check_writing, default_purchase_tax, has_default_company, purchase_tax_rate, default_sale_tax, has_fiscal_year, module_account_payment, sale_tax, group_multi_currency, purchase_tax, group_proforma_invoices, decimal_precision, code_digits, chart_template_id, group_analytic_accounting, group_analytic_account_for_sales, module_sale_analytic_plans, module_purchase_analytic_plans, group_analytic_account_for_purchases', 'safe', 'on'=>'search'),
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
			'saleTax' => array(self::BELONGS_TO, 'AccountTaxTemplate', 'sale_tax'),
			'saleRefundJournal' => array(self::BELONGS_TO, 'AccountJournal', 'sale_refund_journal_id'),
			'saleJournal' => array(self::BELONGS_TO, 'AccountJournal', 'sale_journal_id'),
			'purchaseTax' => array(self::BELONGS_TO, 'AccountTaxTemplate', 'purchase_tax'),
			'purchaseRefundJournal' => array(self::BELONGS_TO, 'AccountJournal', 'purchase_refund_journal_id'),
			'purchaseJournal' => array(self::BELONGS_TO, 'AccountJournal', 'purchase_journal_id'),
			'defaultSaleTax' => array(self::BELONGS_TO, 'AccountTax', 'default_sale_tax'),
			'defaultPurchaseTax' => array(self::BELONGS_TO, 'AccountTax', 'default_purchase_tax'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'chartTemplate' => array(self::BELONGS_TO, 'AccountChartTemplate', 'chart_template_id'),
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
			'sale_journal_id' => 'Sale Journal',
			'module_account_voucher' => 'Module Account Voucher',
			'module_account_asset' => 'Module Account Asset',
			'period' => 'Period',
			'module_account_accountant' => 'Module Account Accountant',
			'module_account_followup' => 'Module Account Followup',
			'purchase_journal_id' => 'Purchase Journal',
			'has_chart_of_accounts' => 'Has Chart Of Accounts',
			'sale_refund_journal_id' => 'Sale Refund Journal',
			'complete_tax_set' => 'Complete Tax Set',
			'module_account_budget' => 'Module Account Budget',
			'date_start' => 'Date Start',
			'purchase_refund_journal_id' => 'Purchase Refund Journal',
			'company_id' => 'Company',
			'sale_tax_rate' => 'Sale Tax Rate',
			'group_check_supplier_invoice_total' => 'Group Check Supplier Invoice Total',
			'module_account_check_writing' => 'Module Account Check Writing',
			'default_purchase_tax' => 'Default Purchase Tax',
			'has_default_company' => 'Has Default Company',
			'purchase_tax_rate' => 'Purchase Tax Rate',
			'default_sale_tax' => 'Default Sale Tax',
			'has_fiscal_year' => 'Has Fiscal Year',
			'module_account_payment' => 'Module Account Payment',
			'sale_tax' => 'Sale Tax',
			'group_multi_currency' => 'Group Multi Currency',
			'purchase_tax' => 'Purchase Tax',
			'group_proforma_invoices' => 'Group Proforma Invoices',
			'decimal_precision' => 'Decimal Precision',
			'code_digits' => 'Code Digits',
			'chart_template_id' => 'Chart Template',
			'group_analytic_accounting' => 'Group Analytic Accounting',
			'group_analytic_account_for_sales' => 'Group Analytic Account For Sales',
			'module_sale_analytic_plans' => 'Module Sale Analytic Plans',
			'module_purchase_analytic_plans' => 'Module Purchase Analytic Plans',
			'group_analytic_account_for_purchases' => 'Group Analytic Account For Purchases',
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
		$criteria->compare('sale_journal_id',$this->sale_journal_id);
		$criteria->compare('module_account_voucher',$this->module_account_voucher);
		$criteria->compare('module_account_asset',$this->module_account_asset);
		$criteria->compare('period',$this->period,true);
		$criteria->compare('module_account_accountant',$this->module_account_accountant);
		$criteria->compare('module_account_followup',$this->module_account_followup);
		$criteria->compare('purchase_journal_id',$this->purchase_journal_id);
		$criteria->compare('has_chart_of_accounts',$this->has_chart_of_accounts);
		$criteria->compare('sale_refund_journal_id',$this->sale_refund_journal_id);
		$criteria->compare('complete_tax_set',$this->complete_tax_set);
		$criteria->compare('module_account_budget',$this->module_account_budget);
		$criteria->compare('date_start',$this->date_start,true);
		$criteria->compare('purchase_refund_journal_id',$this->purchase_refund_journal_id);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('sale_tax_rate',$this->sale_tax_rate);
		$criteria->compare('group_check_supplier_invoice_total',$this->group_check_supplier_invoice_total);
		$criteria->compare('module_account_check_writing',$this->module_account_check_writing);
		$criteria->compare('default_purchase_tax',$this->default_purchase_tax);
		$criteria->compare('has_default_company',$this->has_default_company);
		$criteria->compare('purchase_tax_rate',$this->purchase_tax_rate);
		$criteria->compare('default_sale_tax',$this->default_sale_tax);
		$criteria->compare('has_fiscal_year',$this->has_fiscal_year);
		$criteria->compare('module_account_payment',$this->module_account_payment);
		$criteria->compare('sale_tax',$this->sale_tax);
		$criteria->compare('group_multi_currency',$this->group_multi_currency);
		$criteria->compare('purchase_tax',$this->purchase_tax);
		$criteria->compare('group_proforma_invoices',$this->group_proforma_invoices);
		$criteria->compare('decimal_precision',$this->decimal_precision);
		$criteria->compare('code_digits',$this->code_digits);
		$criteria->compare('chart_template_id',$this->chart_template_id);
		$criteria->compare('group_analytic_accounting',$this->group_analytic_accounting);
		$criteria->compare('group_analytic_account_for_sales',$this->group_analytic_account_for_sales);
		$criteria->compare('module_sale_analytic_plans',$this->module_sale_analytic_plans);
		$criteria->compare('module_purchase_analytic_plans',$this->module_purchase_analytic_plans);
		$criteria->compare('group_analytic_account_for_purchases',$this->group_analytic_account_for_purchases);

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
	 * @return AccountConfigSettings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
