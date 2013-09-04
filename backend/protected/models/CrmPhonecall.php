<?php

/**
 * This is the model class for table "crm_phonecall".
 *
 * The followings are the available columns in table 'crm_phonecall':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $date_closed
 * @property string $description
 * @property string $state
 * @property string $date_action_last
 * @property integer $section_id
 * @property boolean $active
 * @property double $duration
 * @property string $partner_mobile
 * @property string $date
 * @property integer $categ_id
 * @property integer $opportunity_id
 * @property integer $user_id
 * @property string $date_open
 * @property integer $partner_id
 * @property string $date_action_next
 * @property integer $company_id
 * @property string $name
 * @property string $priority
 * @property string $partner_phone
 * @property string $email_from
 *
 * The followings are the available model relations:
 * @property CrmMeeting[] $crmMeetings
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property CrmCaseSection $section
 * @property ResPartner $partner
 * @property CrmLead $opportunity
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property CrmCaseCateg $categ
 */
class CrmPhonecall extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'crm_phonecall';
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
			array('create_uid, write_uid, section_id, categ_id, opportunity_id, user_id, partner_id, company_id', 'numerical', 'integerOnly'=>true),
			array('duration', 'numerical'),
			array('state', 'length', 'max'=>16),
			array('partner_mobile, partner_phone', 'length', 'max'=>32),
			array('name', 'length', 'max'=>64),
			array('email_from', 'length', 'max'=>128),
			array('create_date, write_date, date_closed, description, date_action_last, active, date, date_open, date_action_next, priority', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, date_closed, description, state, date_action_last, section_id, active, duration, partner_mobile, date, categ_id, opportunity_id, user_id, date_open, partner_id, date_action_next, company_id, name, priority, partner_phone, email_from', 'safe', 'on'=>'search'),
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
			'crmMeetings' => array(self::HAS_MANY, 'CrmMeeting', 'phonecall_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'user' => array(self::BELONGS_TO, 'ResUsers', 'user_id'),
			'section' => array(self::BELONGS_TO, 'CrmCaseSection', 'section_id'),
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'opportunity' => array(self::BELONGS_TO, 'CrmLead', 'opportunity_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'categ' => array(self::BELONGS_TO, 'CrmCaseCateg', 'categ_id'),
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
			'description' => 'Description',
			'state' => 'State',
			'date_action_last' => 'Date Action Last',
			'section_id' => 'Section',
			'active' => 'Active',
			'duration' => 'Duration',
			'partner_mobile' => 'Partner Mobile',
			'date' => 'Date',
			'categ_id' => 'Categ',
			'opportunity_id' => 'Opportunity',
			'user_id' => 'User',
			'date_open' => 'Date Open',
			'partner_id' => 'Partner',
			'date_action_next' => 'Date Action Next',
			'company_id' => 'Company',
			'name' => 'Name',
			'priority' => 'Priority',
			'partner_phone' => 'Partner Phone',
			'email_from' => 'Email From',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('date_action_last',$this->date_action_last,true);
		$criteria->compare('section_id',$this->section_id);
		$criteria->compare('active',$this->active);
		$criteria->compare('duration',$this->duration);
		$criteria->compare('partner_mobile',$this->partner_mobile,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('categ_id',$this->categ_id);
		$criteria->compare('opportunity_id',$this->opportunity_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('date_open',$this->date_open,true);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('date_action_next',$this->date_action_next,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('priority',$this->priority,true);
		$criteria->compare('partner_phone',$this->partner_phone,true);
		$criteria->compare('email_from',$this->email_from,true);

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
	 * @return CrmPhonecall the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
