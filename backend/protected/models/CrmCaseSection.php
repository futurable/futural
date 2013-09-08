<?php

/**
 * This is the model class for table "crm_case_section".
 *
 * The followings are the available columns in table 'crm_case_section':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $working_hours
 * @property integer $alias_id
 * @property string $code
 * @property boolean $active
 * @property boolean $change_responsible
 * @property integer $user_id
 * @property string $name
 * @property string $note
 * @property integer $parent_id
 * @property string $complete_name
 * @property string $reply_to
 * @property integer $resource_calendar_id
 *
 * The followings are the available model relations:
 * @property AccountInvoice[] $accountInvoices
 * @property CrmCaseResourceType[] $crmCaseResourceTypes
 * @property CrmCaseCateg[] $crmCaseCategs
 * @property CrmLead[] $crmLeads
 * @property CrmLead2opportunityPartnerMass[] $crmLead2opportunityPartnerMasses
 * @property CrmOpportunity2phonecall[] $crmOpportunity2phonecalls
 * @property CrmPhonecall2phonecall[] $crmPhonecall2phonecalls
 * @property CrmPhonecall[] $crmPhonecalls
 * @property SaleMemberRel[] $saleMemberRels
 * @property SaleOrder[] $saleOrders
 * @property SectionStageRel[] $sectionStageRels
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property ResourceCalendar $resourceCalendar
 * @property CrmCaseSection $parent
 * @property CrmCaseSection[] $crmCaseSections
 * @property ResUsers $createU
 * @property MailAlias $alias
 * @property ResUsers[] $resUsers
 * @property ResPartner[] $resPartners
 * @property CrmPaymentMode[] $crmPaymentModes
 */
class CrmCaseSection extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'crm_case_section';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('alias_id, name', 'required'),
			array('create_uid, write_uid, alias_id, user_id, parent_id, resource_calendar_id', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>8),
			array('name, reply_to', 'length', 'max'=>64),
			array('complete_name', 'length', 'max'=>256),
			array('create_date, write_date, working_hours, active, change_responsible, note', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, working_hours, alias_id, code, active, change_responsible, user_id, name, note, parent_id, complete_name, reply_to, resource_calendar_id', 'safe', 'on'=>'search'),
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
			'accountInvoices' => array(self::HAS_MANY, 'AccountInvoice', 'section_id'),
			'crmCaseResourceTypes' => array(self::HAS_MANY, 'CrmCaseResourceType', 'section_id'),
			'crmCaseCategs' => array(self::HAS_MANY, 'CrmCaseCateg', 'section_id'),
			'crmLeads' => array(self::HAS_MANY, 'CrmLead', 'section_id'),
			'crmLead2opportunityPartnerMasses' => array(self::HAS_MANY, 'CrmLead2opportunityPartnerMass', 'section_id'),
			'crmOpportunity2phonecalls' => array(self::HAS_MANY, 'CrmOpportunity2phonecall', 'section_id'),
			'crmPhonecall2phonecalls' => array(self::HAS_MANY, 'CrmPhonecall2phonecall', 'section_id'),
			'crmPhonecalls' => array(self::HAS_MANY, 'CrmPhonecall', 'section_id'),
			'saleMemberRels' => array(self::HAS_MANY, 'SaleMemberRel', 'section_id'),
			'saleOrders' => array(self::HAS_MANY, 'SaleOrder', 'section_id'),
			'sectionStageRels' => array(self::HAS_MANY, 'SectionStageRel', 'section_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'user' => array(self::BELONGS_TO, 'ResUsers', 'user_id'),
			'resourceCalendar' => array(self::BELONGS_TO, 'ResourceCalendar', 'resource_calendar_id'),
			'parent' => array(self::BELONGS_TO, 'CrmCaseSection', 'parent_id'),
			'crmCaseSections' => array(self::HAS_MANY, 'CrmCaseSection', 'parent_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'alias' => array(self::BELONGS_TO, 'MailAlias', 'alias_id'),
			'resUsers' => array(self::HAS_MANY, 'ResUsers', 'default_section_id'),
			'resPartners' => array(self::HAS_MANY, 'ResPartner', 'section_id'),
			'crmPaymentModes' => array(self::HAS_MANY, 'CrmPaymentMode', 'section_id'),
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
			'working_hours' => 'Working Hours',
			'alias_id' => 'Alias',
			'code' => 'Code',
			'active' => 'Active',
			'change_responsible' => 'Change Responsible',
			'user_id' => 'User',
			'name' => 'Name',
			'note' => 'Note',
			'parent_id' => 'Parent',
			'complete_name' => 'Complete Name',
			'reply_to' => 'Reply To',
			'resource_calendar_id' => 'Resource Calendar',
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
		$criteria->compare('working_hours',$this->working_hours,true);
		$criteria->compare('alias_id',$this->alias_id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('change_responsible',$this->change_responsible);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('complete_name',$this->complete_name,true);
		$criteria->compare('reply_to',$this->reply_to,true);
		$criteria->compare('resource_calendar_id',$this->resource_calendar_id);

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
	 * @return CrmCaseSection the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
