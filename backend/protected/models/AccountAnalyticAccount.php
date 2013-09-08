<?php

/**
 * This is the model class for table "account_analytic_account".
 *
 * The followings are the available columns in table 'account_analytic_account':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $code
 * @property string $description
 * @property double $quantity_max
 * @property integer $currency_id
 * @property string $date
 * @property integer $partner_id
 * @property integer $user_id
 * @property string $name
 * @property integer $parent_id
 * @property string $date_start
 * @property integer $company_id
 * @property string $state
 * @property integer $manager_id
 * @property string $type
 * @property integer $template_id
 * @property boolean $use_tasks
 * @property boolean $use_timesheets
 * @property double $amount_max
 * @property integer $pricelist_id
 * @property integer $to_invoice
 * @property boolean $fix_price_invoices
 * @property double $hours_qtt_est
 * @property boolean $is_overdue_quantity
 * @property boolean $invoice_on_timesheets
 *
 * The followings are the available model relations:
 * @property AccountAnalyticLine[] $accountAnalyticLines
 * @property AccountBankStatementLine[] $accountBankStatementLines
 * @property AccountMoveLine[] $accountMoveLines
 * @property AccountInvoiceTax[] $accountInvoiceTaxes
 * @property AccountModelLine[] $accountModelLines
 * @property AccountMoveLineReconcileWriteoff[] $accountMoveLineReconcileWriteoffs
 * @property AccountVoucherLine[] $accountVoucherLines
 * @property HrSignOutProject[] $hrSignOutProjects
 * @property MrpWorkcenter[] $mrpWorkcenters
 * @property MrpWorkcenter[] $mrpWorkcenters1
 * @property ProjectProject[] $projectProjects
 * @property PurchaseOrderLine[] $purchaseOrderLines
 * @property SaleOrder[] $saleOrders
 * @property AccountInvoiceLine[] $accountInvoiceLines
 * @property AccountTax[] $accountTaxes
 * @property AccountTax[] $accountTaxes1
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property HrTimesheetInvoiceFactor $toInvoice
 * @property AccountAnalyticAccount $template
 * @property AccountAnalyticAccount[] $accountAnalyticAccounts
 * @property ProductPricelist $pricelist
 * @property ResPartner $partner
 * @property AccountAnalyticAccount $parent
 * @property AccountAnalyticAccount[] $accountAnalyticAccounts1
 * @property ResUsers $manager
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property AccountVoucher[] $accountVouchers
 * @property SaleShop[] $saleShops
 */
class AccountAnalyticAccount extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_analytic_account';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, state, type', 'required'),
			array('create_uid, write_uid, currency_id, partner_id, user_id, parent_id, company_id, manager_id, template_id, pricelist_id, to_invoice', 'numerical', 'integerOnly'=>true),
			array('quantity_max, amount_max, hours_qtt_est', 'numerical'),
			array('name', 'length', 'max'=>128),
			array('create_date, write_date, code, description, date, date_start, use_tasks, use_timesheets, fix_price_invoices, is_overdue_quantity, invoice_on_timesheets', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, code, description, quantity_max, currency_id, date, partner_id, user_id, name, parent_id, date_start, company_id, state, manager_id, type, template_id, use_tasks, use_timesheets, amount_max, pricelist_id, to_invoice, fix_price_invoices, hours_qtt_est, is_overdue_quantity, invoice_on_timesheets', 'safe', 'on'=>'search'),
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
			'accountAnalyticLines' => array(self::HAS_MANY, 'AccountAnalyticLine', 'account_id'),
			'accountBankStatementLines' => array(self::HAS_MANY, 'AccountBankStatementLine', 'analytic_account_id'),
			'accountMoveLines' => array(self::HAS_MANY, 'AccountMoveLine', 'analytic_account_id'),
			'accountInvoiceTaxes' => array(self::HAS_MANY, 'AccountInvoiceTax', 'account_analytic_id'),
			'accountModelLines' => array(self::HAS_MANY, 'AccountModelLine', 'analytic_account_id'),
			'accountMoveLineReconcileWriteoffs' => array(self::HAS_MANY, 'AccountMoveLineReconcileWriteoff', 'analytic_id'),
			'accountVoucherLines' => array(self::HAS_MANY, 'AccountVoucherLine', 'account_analytic_id'),
			'hrSignOutProjects' => array(self::HAS_MANY, 'HrSignOutProject', 'account_id'),
			'mrpWorkcenters' => array(self::HAS_MANY, 'MrpWorkcenter', 'costs_hour_account_id'),
			'mrpWorkcenters1' => array(self::HAS_MANY, 'MrpWorkcenter', 'costs_cycle_account_id'),
			'projectProjects' => array(self::HAS_MANY, 'ProjectProject', 'analytic_account_id'),
			'purchaseOrderLines' => array(self::HAS_MANY, 'PurchaseOrderLine', 'account_analytic_id'),
			'saleOrders' => array(self::HAS_MANY, 'SaleOrder', 'project_id'),
			'accountInvoiceLines' => array(self::HAS_MANY, 'AccountInvoiceLine', 'account_analytic_id'),
			'accountTaxes' => array(self::HAS_MANY, 'AccountTax', 'account_analytic_paid_id'),
			'accountTaxes1' => array(self::HAS_MANY, 'AccountTax', 'account_analytic_collected_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'user' => array(self::BELONGS_TO, 'ResUsers', 'user_id'),
			'toInvoice' => array(self::BELONGS_TO, 'HrTimesheetInvoiceFactor', 'to_invoice'),
			'template' => array(self::BELONGS_TO, 'AccountAnalyticAccount', 'template_id'),
			'accountAnalyticAccounts' => array(self::HAS_MANY, 'AccountAnalyticAccount', 'template_id'),
			'pricelist' => array(self::BELONGS_TO, 'ProductPricelist', 'pricelist_id'),
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'parent' => array(self::BELONGS_TO, 'AccountAnalyticAccount', 'parent_id'),
			'accountAnalyticAccounts1' => array(self::HAS_MANY, 'AccountAnalyticAccount', 'parent_id'),
			'manager' => array(self::BELONGS_TO, 'ResUsers', 'manager_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'accountVouchers' => array(self::HAS_MANY, 'AccountVoucher', 'analytic_id'),
			'saleShops' => array(self::HAS_MANY, 'SaleShop', 'project_id'),
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
			'code' => 'Code',
			'description' => 'Description',
			'quantity_max' => 'Quantity Max',
			'currency_id' => 'Currency',
			'date' => 'Date',
			'partner_id' => 'Partner',
			'user_id' => 'User',
			'name' => 'Name',
			'parent_id' => 'Parent',
			'date_start' => 'Date Start',
			'company_id' => 'Company',
			'state' => 'State',
			'manager_id' => 'Manager',
			'type' => 'Type',
			'template_id' => 'Template',
			'use_tasks' => 'Use Tasks',
			'use_timesheets' => 'Use Timesheets',
			'amount_max' => 'Amount Max',
			'pricelist_id' => 'Pricelist',
			'to_invoice' => 'To Invoice',
			'fix_price_invoices' => 'Fix Price Invoices',
			'hours_qtt_est' => 'Hours Qtt Est',
			'is_overdue_quantity' => 'Is Overdue Quantity',
			'invoice_on_timesheets' => 'Invoice On Timesheets',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('quantity_max',$this->quantity_max);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('date_start',$this->date_start,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('manager_id',$this->manager_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('template_id',$this->template_id);
		$criteria->compare('use_tasks',$this->use_tasks);
		$criteria->compare('use_timesheets',$this->use_timesheets);
		$criteria->compare('amount_max',$this->amount_max);
		$criteria->compare('pricelist_id',$this->pricelist_id);
		$criteria->compare('to_invoice',$this->to_invoice);
		$criteria->compare('fix_price_invoices',$this->fix_price_invoices);
		$criteria->compare('hours_qtt_est',$this->hours_qtt_est);
		$criteria->compare('is_overdue_quantity',$this->is_overdue_quantity);
		$criteria->compare('invoice_on_timesheets',$this->invoice_on_timesheets);

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
	 * @return AccountAnalyticAccount the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
