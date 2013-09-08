<?php

/**
 * This is the model class for table "res_partner".
 *
 * The followings are the available columns in table 'res_partner':
 * @property integer $id
 * @property string $name
 * @property string $lang
 * @property integer $company_id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $comment
 * @property string $ean13
 * @property integer $color
 * @property string $image
 * @property boolean $use_parent_address
 * @property boolean $active
 * @property string $street
 * @property boolean $supplier
 * @property string $city
 * @property integer $user_id
 * @property string $zip
 * @property integer $title
 * @property string $function
 * @property integer $country_id
 * @property integer $parent_id
 * @property boolean $employee
 * @property string $type
 * @property string $email
 * @property string $vat
 * @property string $website
 * @property string $fax
 * @property string $street2
 * @property string $phone
 * @property double $credit_limit
 * @property string $date
 * @property string $tz
 * @property boolean $customer
 * @property string $image_medium
 * @property string $mobile
 * @property string $ref
 * @property string $image_small
 * @property string $birthdate
 * @property boolean $is_company
 * @property integer $state_id
 * @property string $notification_email_send
 * @property boolean $opt_out
 * @property string $signup_type
 * @property string $signup_expiration
 * @property string $signup_token
 * @property string $last_reconciliation_date
 * @property double $debit_limit
 * @property string $display_name
 * @property boolean $vat_subjected
 * @property integer $section_id
 *
 * The followings are the available model relations:
 * @property AccountBankStatementLine[] $accountBankStatementLines
 * @property AccountMoveLine[] $accountMoveLines
 * @property AccountInvoice[] $accountInvoices
 * @property AccountPartnerReconcileProcess[] $accountPartnerReconcileProcesses
 * @property AccountModelLine[] $accountModelLines
 * @property BaseActionRuleLeadTest[] $baseActionRuleLeadTests
 * @property CalendarEventResPartnerRel[] $calendarEventResPartnerRels
 * @property CalendarTodoResPartnerRel[] $calendarTodoResPartnerRels
 * @property CalendarAttendee[] $calendarAttendees
 * @property CrmLead[] $crmLeads
 * @property CrmLead2opportunityPartnerMass[] $crmLead2opportunityPartnerMasses
 * @property CrmLead2opportunityPartner[] $crmLead2opportunityPartners
 * @property CrmMakeSale[] $crmMakeSales
 * @property CrmOpportunity2phonecall[] $crmOpportunity2phonecalls
 * @property CrmPhonecall2phonecall[] $crmPhonecall2phonecalls
 * @property CrmPartnerBinding[] $crmPartnerBindings
 * @property CrmPhonecall[] $crmPhonecalls
 * @property CrmMeetingPartnerRel[] $crmMeetingPartnerRels
 * @property HrEmployee[] $hrEmployees
 * @property HrEmployee[] $hrEmployees1
 * @property MailFollowers[] $mailFollowers
 * @property MailComposeMessage[] $mailComposeMessages
 * @property MailComposeMessageResPartnerRel[] $mailComposeMessageResPartnerRels
 * @property MailWizardInviteResPartnerRel[] $mailWizardInviteResPartnerRels
 * @property MailMessageResPartnerRel[] $mailMessageResPartnerRels
 * @property MailNotification[] $mailNotifications
 * @property ProjectTask[] $projectTasks
 * @property PurchaseOrder[] $purchaseOrders
 * @property PurchaseOrder[] $purchaseOrders1
 * @property StockMove[] $stockMoves
 * @property StockPicking[] $stockPickings
 * @property ResPartnerBank[] $resPartnerBanks
 * @property ResRequest[] $resRequests
 * @property ResPartnerResPartnerCategoryRel[] $resPartnerResPartnerCategoryRels
 * @property SaleOrder[] $saleOrders
 * @property SaleOrder[] $saleOrders1
 * @property SaleOrder[] $saleOrders2
 * @property SaleOrderLine[] $saleOrderLines
 * @property AccountAnalyticAccount[] $accountAnalyticAccounts
 * @property ResCompany[] $resCompanies
 * @property AccountVoucher[] $accountVouchers
 * @property ResUsers[] $resUsers
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property ResPartnerTitle $title0
 * @property ResCountryState $state
 * @property CrmCaseSection $section
 * @property ResPartner $parent
 * @property ResPartner[] $resPartners
 * @property ResUsers $createU
 * @property ResCountry $country
 * @property ResCompany $company
 * @property BaseActionRuleResPartnerRel[] $baseActionRuleResPartnerRels
 * @property ProductSupplierinfo[] $productSupplierinfos
 * @property MailMessage[] $mailMessages
 * @property StockLocation[] $stockLocations
 * @property StockWarehouse[] $stockWarehouses
 */
class ResPartner extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'res_partner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, notification_email_send', 'required'),
			array('company_id, create_uid, write_uid, color, user_id, title, country_id, parent_id, state_id, section_id', 'numerical', 'integerOnly'=>true),
			array('credit_limit, debit_limit', 'numerical'),
			array('name, street, city, function, street2', 'length', 'max'=>128),
			array('lang, website, fax, phone, tz, mobile, ref, birthdate', 'length', 'max'=>64),
			array('ean13', 'length', 'max'=>13),
			array('zip', 'length', 'max'=>24),
			array('email', 'length', 'max'=>240),
			array('vat', 'length', 'max'=>32),
			array('create_date, write_date, comment, image, use_parent_address, active, supplier, employee, type, date, customer, image_medium, image_small, is_company, opt_out, signup_type, signup_expiration, signup_token, last_reconciliation_date, display_name, vat_subjected', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, lang, company_id, create_uid, create_date, write_date, write_uid, comment, ean13, color, image, use_parent_address, active, street, supplier, city, user_id, zip, title, function, country_id, parent_id, employee, type, email, vat, website, fax, street2, phone, credit_limit, date, tz, customer, image_medium, mobile, ref, image_small, birthdate, is_company, state_id, notification_email_send, opt_out, signup_type, signup_expiration, signup_token, last_reconciliation_date, debit_limit, display_name, vat_subjected, section_id', 'safe', 'on'=>'search'),
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
			'accountBankStatementLines' => array(self::HAS_MANY, 'AccountBankStatementLine', 'partner_id'),
			'accountMoveLines' => array(self::HAS_MANY, 'AccountMoveLine', 'partner_id'),
			'accountInvoices' => array(self::HAS_MANY, 'AccountInvoice', 'partner_id'),
			'accountPartnerReconcileProcesses' => array(self::HAS_MANY, 'AccountPartnerReconcileProcess', 'next_partner_id'),
			'accountModelLines' => array(self::HAS_MANY, 'AccountModelLine', 'partner_id'),
			'baseActionRuleLeadTests' => array(self::HAS_MANY, 'BaseActionRuleLeadTest', 'partner_id'),
			'calendarEventResPartnerRels' => array(self::HAS_MANY, 'CalendarEventResPartnerRel', 'res_partner_id'),
			'calendarTodoResPartnerRels' => array(self::HAS_MANY, 'CalendarTodoResPartnerRel', 'res_partner_id'),
			'calendarAttendees' => array(self::HAS_MANY, 'CalendarAttendee', 'partner_id'),
			'crmLeads' => array(self::HAS_MANY, 'CrmLead', 'partner_id'),
			'crmLead2opportunityPartnerMasses' => array(self::HAS_MANY, 'CrmLead2opportunityPartnerMass', 'partner_id'),
			'crmLead2opportunityPartners' => array(self::HAS_MANY, 'CrmLead2opportunityPartner', 'partner_id'),
			'crmMakeSales' => array(self::HAS_MANY, 'CrmMakeSale', 'partner_id'),
			'crmOpportunity2phonecalls' => array(self::HAS_MANY, 'CrmOpportunity2phonecall', 'partner_id'),
			'crmPhonecall2phonecalls' => array(self::HAS_MANY, 'CrmPhonecall2phonecall', 'partner_id'),
			'crmPartnerBindings' => array(self::HAS_MANY, 'CrmPartnerBinding', 'partner_id'),
			'crmPhonecalls' => array(self::HAS_MANY, 'CrmPhonecall', 'partner_id'),
			'crmMeetingPartnerRels' => array(self::HAS_MANY, 'CrmMeetingPartnerRel', 'partner_id'),
			'hrEmployees' => array(self::HAS_MANY, 'HrEmployee', 'address_id'),
			'hrEmployees1' => array(self::HAS_MANY, 'HrEmployee', 'address_home_id'),
			'mailFollowers' => array(self::HAS_MANY, 'MailFollowers', 'partner_id'),
			'mailComposeMessages' => array(self::HAS_MANY, 'MailComposeMessage', 'author_id'),
			'mailComposeMessageResPartnerRels' => array(self::HAS_MANY, 'MailComposeMessageResPartnerRel', 'partner_id'),
			'mailWizardInviteResPartnerRels' => array(self::HAS_MANY, 'MailWizardInviteResPartnerRel', 'res_partner_id'),
			'mailMessageResPartnerRels' => array(self::HAS_MANY, 'MailMessageResPartnerRel', 'res_partner_id'),
			'mailNotifications' => array(self::HAS_MANY, 'MailNotification', 'partner_id'),
			'projectTasks' => array(self::HAS_MANY, 'ProjectTask', 'partner_id'),
			'purchaseOrders' => array(self::HAS_MANY, 'PurchaseOrder', 'partner_id'),
			'purchaseOrders1' => array(self::HAS_MANY, 'PurchaseOrder', 'dest_address_id'),
			'stockMoves' => array(self::HAS_MANY, 'StockMove', 'partner_id'),
			'stockPickings' => array(self::HAS_MANY, 'StockPicking', 'partner_id'),
			'resPartnerBanks' => array(self::HAS_MANY, 'ResPartnerBank', 'partner_id'),
			'resRequests' => array(self::HAS_MANY, 'ResRequest', 'ref_partner_id'),
			'resPartnerResPartnerCategoryRels' => array(self::HAS_MANY, 'ResPartnerResPartnerCategoryRel', 'partner_id'),
			'saleOrders' => array(self::HAS_MANY, 'SaleOrder', 'partner_shipping_id'),
			'saleOrders1' => array(self::HAS_MANY, 'SaleOrder', 'partner_invoice_id'),
			'saleOrders2' => array(self::HAS_MANY, 'SaleOrder', 'partner_id'),
			'saleOrderLines' => array(self::HAS_MANY, 'SaleOrderLine', 'address_allotment_id'),
			'accountAnalyticAccounts' => array(self::HAS_MANY, 'AccountAnalyticAccount', 'partner_id'),
			'resCompanies' => array(self::HAS_MANY, 'ResCompany', 'partner_id'),
			'accountVouchers' => array(self::HAS_MANY, 'AccountVoucher', 'partner_id'),
			'resUsers' => array(self::HAS_MANY, 'ResUsers', 'partner_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'user' => array(self::BELONGS_TO, 'ResUsers', 'user_id'),
			'title0' => array(self::BELONGS_TO, 'ResPartnerTitle', 'title'),
			'state' => array(self::BELONGS_TO, 'ResCountryState', 'state_id'),
			'section' => array(self::BELONGS_TO, 'CrmCaseSection', 'section_id'),
			'parent' => array(self::BELONGS_TO, 'ResPartner', 'parent_id'),
			'resPartners' => array(self::HAS_MANY, 'ResPartner', 'parent_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'country' => array(self::BELONGS_TO, 'ResCountry', 'country_id'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'baseActionRuleResPartnerRels' => array(self::HAS_MANY, 'BaseActionRuleResPartnerRel', 'res_partner_id'),
			'productSupplierinfos' => array(self::HAS_MANY, 'ProductSupplierinfo', 'name'),
			'mailMessages' => array(self::HAS_MANY, 'MailMessage', 'author_id'),
			'stockLocations' => array(self::HAS_MANY, 'StockLocation', 'partner_id'),
			'stockWarehouses' => array(self::HAS_MANY, 'StockWarehouse', 'partner_id'),
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
			'lang' => 'Lang',
			'company_id' => 'Company',
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'comment' => 'Comment',
			'ean13' => 'Ean13',
			'color' => 'Color',
			'image' => 'Image',
			'use_parent_address' => 'Use Parent Address',
			'active' => 'Active',
			'street' => 'Street',
			'supplier' => 'Supplier',
			'city' => 'City',
			'user_id' => 'User',
			'zip' => 'Zip',
			'title' => 'Title',
			'function' => 'Function',
			'country_id' => 'Country',
			'parent_id' => 'Parent',
			'employee' => 'Employee',
			'type' => 'Type',
			'email' => 'Email',
			'vat' => 'Vat',
			'website' => 'Website',
			'fax' => 'Fax',
			'street2' => 'Street2',
			'phone' => 'Phone',
			'credit_limit' => 'Credit Limit',
			'date' => 'Date',
			'tz' => 'Tz',
			'customer' => 'Customer',
			'image_medium' => 'Image Medium',
			'mobile' => 'Mobile',
			'ref' => 'Ref',
			'image_small' => 'Image Small',
			'birthdate' => 'Birthdate',
			'is_company' => 'Is Company',
			'state_id' => 'State',
			'notification_email_send' => 'Notification Email Send',
			'opt_out' => 'Opt Out',
			'signup_type' => 'Signup Type',
			'signup_expiration' => 'Signup Expiration',
			'signup_token' => 'Signup Token',
			'last_reconciliation_date' => 'Last Reconciliation Date',
			'debit_limit' => 'Debit Limit',
			'display_name' => 'Display Name',
			'vat_subjected' => 'Vat Subjected',
			'section_id' => 'Section',
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
		$criteria->compare('lang',$this->lang,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('ean13',$this->ean13,true);
		$criteria->compare('color',$this->color);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('use_parent_address',$this->use_parent_address);
		$criteria->compare('active',$this->active);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('supplier',$this->supplier);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('zip',$this->zip,true);
		$criteria->compare('title',$this->title);
		$criteria->compare('function',$this->function,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('employee',$this->employee);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('vat',$this->vat,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('street2',$this->street2,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('credit_limit',$this->credit_limit);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('tz',$this->tz,true);
		$criteria->compare('customer',$this->customer);
		$criteria->compare('image_medium',$this->image_medium,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('ref',$this->ref,true);
		$criteria->compare('image_small',$this->image_small,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('is_company',$this->is_company);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('notification_email_send',$this->notification_email_send,true);
		$criteria->compare('opt_out',$this->opt_out);
		$criteria->compare('signup_type',$this->signup_type,true);
		$criteria->compare('signup_expiration',$this->signup_expiration,true);
		$criteria->compare('signup_token',$this->signup_token,true);
		$criteria->compare('last_reconciliation_date',$this->last_reconciliation_date,true);
		$criteria->compare('debit_limit',$this->debit_limit);
		$criteria->compare('display_name',$this->display_name,true);
		$criteria->compare('vat_subjected',$this->vat_subjected);
		$criteria->compare('section_id',$this->section_id);

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
	 * @return ResPartner the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
