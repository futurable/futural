<?php

/**
 * This is the model class for table "crm_lead".
 *
 * The followings are the available columns in table 'crm_lead':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $date_closed
 * @property integer $type_id
 * @property integer $color
 * @property string $date_action_last
 * @property string $day_close
 * @property boolean $active
 * @property string $street
 * @property string $day_open
 * @property string $contact_name
 * @property integer $partner_id
 * @property string $city
 * @property string $date_open
 * @property integer $user_id
 * @property boolean $opt_out
 * @property integer $title
 * @property string $partner_name
 * @property double $planned_revenue
 * @property integer $country_id
 * @property integer $company_id
 * @property string $priority
 * @property string $state
 * @property string $email_cc
 * @property string $date_action_next
 * @property string $type
 * @property string $street2
 * @property string $function
 * @property string $fax
 * @property string $description
 * @property double $planned_cost
 * @property string $ref2
 * @property integer $section_id
 * @property string $title_action
 * @property string $phone
 * @property double $probability
 * @property integer $payment_mode
 * @property string $date_action
 * @property string $name
 * @property integer $stage_id
 * @property string $zip
 * @property string $date_deadline
 * @property string $mobile
 * @property string $ref
 * @property integer $channel_id
 * @property integer $state_id
 * @property string $email_from
 * @property string $referred
 *
 * The followings are the available model relations:
 * @property CrmMeeting[] $crmMeetings
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property CrmCaseResourceType $type0
 * @property ResPartnerTitle $title0
 * @property ResCountryState $state0
 * @property CrmCaseStage $stage
 * @property CrmCaseSection $section
 * @property CrmPaymentMode $paymentMode
 * @property ResPartner $partner
 * @property ResUsers $createU
 * @property ResCountry $country
 * @property ResCompany $company
 * @property CrmCaseChannel $channel
 * @property CrmLeadCrmLead2opportunityPartnerRel[] $crmLeadCrmLead2opportunityPartnerRels
 * @property CrmLeadCategoryRel[] $crmLeadCategoryRels
 * @property CrmLeadCrmLead2opportunityPartnerMassRel[] $crmLeadCrmLead2opportunityPartnerMassRels
 * @property CrmPhonecall[] $crmPhonecalls
 * @property MergeOpportunityRel[] $mergeOpportunityRels
 */
class CrmLead extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'crm_lead';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('create_uid, write_uid, type_id, color, partner_id, user_id, title, country_id, company_id, section_id, payment_mode, stage_id, channel_id, state_id', 'numerical', 'integerOnly'=>true),
			array('planned_revenue, planned_cost, probability', 'numerical'),
			array('street, city, street2, function, ref2, ref, email_from', 'length', 'max'=>128),
			array('contact_name, partner_name, fax, title_action, phone, name, mobile, referred', 'length', 'max'=>64),
			array('zip', 'length', 'max'=>24),
			array('create_date, write_date, date_closed, date_action_last, day_close, active, day_open, date_open, opt_out, priority, state, email_cc, date_action_next, type, description, date_action, date_deadline', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, date_closed, type_id, color, date_action_last, day_close, active, street, day_open, contact_name, partner_id, city, date_open, user_id, opt_out, title, partner_name, planned_revenue, country_id, company_id, priority, state, email_cc, date_action_next, type, street2, function, fax, description, planned_cost, ref2, section_id, title_action, phone, probability, payment_mode, date_action, name, stage_id, zip, date_deadline, mobile, ref, channel_id, state_id, email_from, referred', 'safe', 'on'=>'search'),
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
			'crmMeetings' => array(self::HAS_MANY, 'CrmMeeting', 'opportunity_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'user' => array(self::BELONGS_TO, 'ResUsers', 'user_id'),
			'type0' => array(self::BELONGS_TO, 'CrmCaseResourceType', 'type_id'),
			'title0' => array(self::BELONGS_TO, 'ResPartnerTitle', 'title'),
			'state0' => array(self::BELONGS_TO, 'ResCountryState', 'state_id'),
			'stage' => array(self::BELONGS_TO, 'CrmCaseStage', 'stage_id'),
			'section' => array(self::BELONGS_TO, 'CrmCaseSection', 'section_id'),
			'paymentMode' => array(self::BELONGS_TO, 'CrmPaymentMode', 'payment_mode'),
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'country' => array(self::BELONGS_TO, 'ResCountry', 'country_id'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'channel' => array(self::BELONGS_TO, 'CrmCaseChannel', 'channel_id'),
			'crmLeadCrmLead2opportunityPartnerRels' => array(self::HAS_MANY, 'CrmLeadCrmLead2opportunityPartnerRel', 'crm_lead_id'),
			'crmLeadCategoryRels' => array(self::HAS_MANY, 'CrmLeadCategoryRel', 'lead_id'),
			'crmLeadCrmLead2opportunityPartnerMassRels' => array(self::HAS_MANY, 'CrmLeadCrmLead2opportunityPartnerMassRel', 'crm_lead_id'),
			'crmPhonecalls' => array(self::HAS_MANY, 'CrmPhonecall', 'opportunity_id'),
			'mergeOpportunityRels' => array(self::HAS_MANY, 'MergeOpportunityRel', 'opportunity_id'),
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
			'date_closed' => 'Date Closed',
			'type_id' => 'Type',
			'color' => 'Color',
			'date_action_last' => 'Date Action Last',
			'day_close' => 'Day Close',
			'active' => 'Active',
			'street' => 'Street',
			'day_open' => 'Day Open',
			'contact_name' => 'Contact Name',
			'partner_id' => 'Partner',
			'city' => 'City',
			'date_open' => 'Date Open',
			'user_id' => 'User',
			'opt_out' => 'Opt Out',
			'title' => 'Title',
			'partner_name' => 'Partner Name',
			'planned_revenue' => 'Planned Revenue',
			'country_id' => 'Country',
			'company_id' => 'Company',
			'priority' => 'Priority',
			'state' => 'State',
			'email_cc' => 'Email Cc',
			'date_action_next' => 'Date Action Next',
			'type' => 'Type',
			'street2' => 'Street2',
			'function' => 'Function',
			'fax' => 'Fax',
			'description' => 'Description',
			'planned_cost' => 'Planned Cost',
			'ref2' => 'Ref2',
			'section_id' => 'Section',
			'title_action' => 'Title Action',
			'phone' => 'Phone',
			'probability' => 'Probability',
			'payment_mode' => 'Payment Mode',
			'date_action' => 'Date Action',
			'name' => 'Name',
			'stage_id' => 'Stage',
			'zip' => 'Zip',
			'date_deadline' => 'Date Deadline',
			'mobile' => 'Mobile',
			'ref' => 'Ref',
			'channel_id' => 'Channel',
			'state_id' => 'State',
			'email_from' => 'Email From',
			'referred' => 'Referred',
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
		$criteria->compare('date_closed',$this->date_closed,true);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('color',$this->color);
		$criteria->compare('date_action_last',$this->date_action_last,true);
		$criteria->compare('day_close',$this->day_close,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('day_open',$this->day_open,true);
		$criteria->compare('contact_name',$this->contact_name,true);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('date_open',$this->date_open,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('opt_out',$this->opt_out);
		$criteria->compare('title',$this->title);
		$criteria->compare('partner_name',$this->partner_name,true);
		$criteria->compare('planned_revenue',$this->planned_revenue);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('priority',$this->priority,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('email_cc',$this->email_cc,true);
		$criteria->compare('date_action_next',$this->date_action_next,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('street2',$this->street2,true);
		$criteria->compare('function',$this->function,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('planned_cost',$this->planned_cost);
		$criteria->compare('ref2',$this->ref2,true);
		$criteria->compare('section_id',$this->section_id);
		$criteria->compare('title_action',$this->title_action,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('probability',$this->probability);
		$criteria->compare('payment_mode',$this->payment_mode);
		$criteria->compare('date_action',$this->date_action,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('stage_id',$this->stage_id);
		$criteria->compare('zip',$this->zip,true);
		$criteria->compare('date_deadline',$this->date_deadline,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('ref',$this->ref,true);
		$criteria->compare('channel_id',$this->channel_id);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('email_from',$this->email_from,true);
		$criteria->compare('referred',$this->referred,true);

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
	 * @return CrmLead the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
