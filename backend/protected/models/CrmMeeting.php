<?php

/**
 * This is the model class for table "crm_meeting".
 *
 * The followings are the available columns in table 'crm_meeting':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $date_closed
 * @property boolean $allday
 * @property integer $sequence
 * @property boolean $we
 * @property integer $base_calendar_alarm_id
 * @property string $rrule
 * @property double $duration
 * @property string $organizer
 * @property integer $month_list
 * @property integer $user_id
 * @property string $vtimezone
 * @property boolean $tu
 * @property boolean $recurrency
 * @property string $week_list
 * @property string $state
 * @property string $base_calendar_url
 * @property string $location
 * @property boolean $th
 * @property string $exrule
 * @property string $exdate
 * @property boolean $fr
 * @property string $recurrent_id_date
 * @property string $description
 * @property string $end_date
 * @property string $class
 * @property string $byday
 * @property string $date
 * @property boolean $active
 * @property integer $day
 * @property string $name
 * @property integer $count
 * @property string $end_type
 * @property string $date_open
 * @property string $date_deadline
 * @property boolean $mo
 * @property integer $interval
 * @property boolean $su
 * @property integer $alarm_id
 * @property integer $recurrent_id
 * @property string $select1
 * @property integer $organizer_id
 * @property boolean $sa
 * @property string $rrule_type
 * @property string $show_as
 * @property integer $opportunity_id
 * @property integer $phonecall_id
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property CrmPhonecall $phonecall
 * @property ResUsers $organizer0
 * @property CrmLead $opportunity
 * @property ResUsers $createU
 * @property CalendarAlarm $baseCalendarAlarm
 * @property ResAlarm $alarm
 * @property CrmMeetingPartnerRel[] $crmMeetingPartnerRels
 * @property MeetingAttendeeRel[] $meetingAttendeeRels
 * @property MeetingCategoryRel[] $meetingCategoryRels
 */
class CrmMeeting extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'crm_meeting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, name, date_deadline', 'required'),
			array('create_uid, write_uid, sequence, base_calendar_alarm_id, month_list, user_id, day, count, interval, alarm_id, recurrent_id, organizer_id, opportunity_id, phonecall_id', 'numerical', 'integerOnly'=>true),
			array('duration', 'numerical'),
			array('rrule', 'length', 'max'=>124),
			array('organizer', 'length', 'max'=>256),
			array('vtimezone', 'length', 'max'=>64),
			array('state', 'length', 'max'=>16),
			array('base_calendar_url, location', 'length', 'max'=>264),
			array('exrule', 'length', 'max'=>352),
			array('name', 'length', 'max'=>128),
			array('create_date, write_date, date_closed, allday, we, tu, recurrency, week_list, th, exdate, fr, recurrent_id_date, description, end_date, class, byday, active, end_type, date_open, mo, su, select1, sa, rrule_type, show_as', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, date_closed, allday, sequence, we, base_calendar_alarm_id, rrule, duration, organizer, month_list, user_id, vtimezone, tu, recurrency, week_list, state, base_calendar_url, location, th, exrule, exdate, fr, recurrent_id_date, description, end_date, class, byday, date, active, day, name, count, end_type, date_open, date_deadline, mo, interval, su, alarm_id, recurrent_id, select1, organizer_id, sa, rrule_type, show_as, opportunity_id, phonecall_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'ResUsers', 'user_id'),
			'phonecall' => array(self::BELONGS_TO, 'CrmPhonecall', 'phonecall_id'),
			'organizer0' => array(self::BELONGS_TO, 'ResUsers', 'organizer_id'),
			'opportunity' => array(self::BELONGS_TO, 'CrmLead', 'opportunity_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'baseCalendarAlarm' => array(self::BELONGS_TO, 'CalendarAlarm', 'base_calendar_alarm_id'),
			'alarm' => array(self::BELONGS_TO, 'ResAlarm', 'alarm_id'),
			'crmMeetingPartnerRels' => array(self::HAS_MANY, 'CrmMeetingPartnerRel', 'meeting_id'),
			'meetingAttendeeRels' => array(self::HAS_MANY, 'MeetingAttendeeRel', 'event_id'),
			'meetingCategoryRels' => array(self::HAS_MANY, 'MeetingCategoryRel', 'event_id'),
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
			'allday' => 'Allday',
			'sequence' => 'Sequence',
			'we' => 'We',
			'base_calendar_alarm_id' => 'Base Calendar Alarm',
			'rrule' => 'Rrule',
			'duration' => 'Duration',
			'organizer' => 'Organizer',
			'month_list' => 'Month List',
			'user_id' => 'User',
			'vtimezone' => 'Vtimezone',
			'tu' => 'Tu',
			'recurrency' => 'Recurrency',
			'week_list' => 'Week List',
			'state' => 'State',
			'base_calendar_url' => 'Base Calendar Url',
			'location' => 'Location',
			'th' => 'Th',
			'exrule' => 'Exrule',
			'exdate' => 'Exdate',
			'fr' => 'Fr',
			'recurrent_id_date' => 'Recurrent Id Date',
			'description' => 'Description',
			'end_date' => 'End Date',
			'class' => 'Class',
			'byday' => 'Byday',
			'date' => 'Date',
			'active' => 'Active',
			'day' => 'Day',
			'name' => 'Name',
			'count' => 'Count',
			'end_type' => 'End Type',
			'date_open' => 'Date Open',
			'date_deadline' => 'Date Deadline',
			'mo' => 'Mo',
			'interval' => 'Interval',
			'su' => 'Su',
			'alarm_id' => 'Alarm',
			'recurrent_id' => 'Recurrent',
			'select1' => 'Select1',
			'organizer_id' => 'Organizer',
			'sa' => 'Sa',
			'rrule_type' => 'Rrule Type',
			'show_as' => 'Show As',
			'opportunity_id' => 'Opportunity',
			'phonecall_id' => 'Phonecall',
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
		$criteria->compare('allday',$this->allday);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('we',$this->we);
		$criteria->compare('base_calendar_alarm_id',$this->base_calendar_alarm_id);
		$criteria->compare('rrule',$this->rrule,true);
		$criteria->compare('duration',$this->duration);
		$criteria->compare('organizer',$this->organizer,true);
		$criteria->compare('month_list',$this->month_list);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('vtimezone',$this->vtimezone,true);
		$criteria->compare('tu',$this->tu);
		$criteria->compare('recurrency',$this->recurrency);
		$criteria->compare('week_list',$this->week_list,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('base_calendar_url',$this->base_calendar_url,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('th',$this->th);
		$criteria->compare('exrule',$this->exrule,true);
		$criteria->compare('exdate',$this->exdate,true);
		$criteria->compare('fr',$this->fr);
		$criteria->compare('recurrent_id_date',$this->recurrent_id_date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('class',$this->class,true);
		$criteria->compare('byday',$this->byday,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('day',$this->day);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('count',$this->count);
		$criteria->compare('end_type',$this->end_type,true);
		$criteria->compare('date_open',$this->date_open,true);
		$criteria->compare('date_deadline',$this->date_deadline,true);
		$criteria->compare('mo',$this->mo);
		$criteria->compare('interval',$this->interval);
		$criteria->compare('su',$this->su);
		$criteria->compare('alarm_id',$this->alarm_id);
		$criteria->compare('recurrent_id',$this->recurrent_id);
		$criteria->compare('select1',$this->select1,true);
		$criteria->compare('organizer_id',$this->organizer_id);
		$criteria->compare('sa',$this->sa);
		$criteria->compare('rrule_type',$this->rrule_type,true);
		$criteria->compare('show_as',$this->show_as,true);
		$criteria->compare('opportunity_id',$this->opportunity_id);
		$criteria->compare('phonecall_id',$this->phonecall_id);

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
	 * @return CrmMeeting the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
