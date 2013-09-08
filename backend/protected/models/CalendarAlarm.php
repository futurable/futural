<?php

/**
 * This is the model class for table "calendar_alarm".
 *
 * The followings are the available columns in table 'calendar_alarm':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $model_id
 * @property integer $repeat
 * @property string $description
 * @property string $trigger_occurs
 * @property integer $duration
 * @property boolean $active
 * @property string $trigger_related
 * @property integer $trigger_duration
 * @property integer $user_id
 * @property string $name
 * @property string $attach
 * @property string $event_end_date
 * @property string $trigger_interval
 * @property integer $alarm_id
 * @property string $state
 * @property string $action
 * @property string $event_date
 * @property string $trigger_date
 * @property integer $res_id
 *
 * The followings are the available model relations:
 * @property AlarmAttendeeRel[] $alarmAttendeeRels
 * @property CalendarEvent[] $calendarEvents
 * @property CalendarTodo[] $calendarTodos
 * @property CrmMeeting[] $crmMeetings
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property IrModel $model
 * @property ResUsers $createU
 * @property ResAlarm $alarm
 */
class CalendarAlarm extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'calendar_alarm';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('trigger_occurs, trigger_related, trigger_duration, trigger_interval, action', 'required'),
			array('create_uid, write_uid, model_id, repeat, duration, trigger_duration, user_id, alarm_id, res_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>124),
			array('create_date, write_date, description, active, attach, event_end_date, state, event_date, trigger_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, model_id, repeat, description, trigger_occurs, duration, active, trigger_related, trigger_duration, user_id, name, attach, event_end_date, trigger_interval, alarm_id, state, action, event_date, trigger_date, res_id', 'safe', 'on'=>'search'),
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
			'alarmAttendeeRels' => array(self::HAS_MANY, 'AlarmAttendeeRel', 'alarm_id'),
			'calendarEvents' => array(self::HAS_MANY, 'CalendarEvent', 'base_calendar_alarm_id'),
			'calendarTodos' => array(self::HAS_MANY, 'CalendarTodo', 'base_calendar_alarm_id'),
			'crmMeetings' => array(self::HAS_MANY, 'CrmMeeting', 'base_calendar_alarm_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'user' => array(self::BELONGS_TO, 'ResUsers', 'user_id'),
			'model' => array(self::BELONGS_TO, 'IrModel', 'model_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'alarm' => array(self::BELONGS_TO, 'ResAlarm', 'alarm_id'),
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
			'model_id' => 'Model',
			'repeat' => 'Repeat',
			'description' => 'Description',
			'trigger_occurs' => 'Trigger Occurs',
			'duration' => 'Duration',
			'active' => 'Active',
			'trigger_related' => 'Trigger Related',
			'trigger_duration' => 'Trigger Duration',
			'user_id' => 'User',
			'name' => 'Name',
			'attach' => 'Attach',
			'event_end_date' => 'Event End Date',
			'trigger_interval' => 'Trigger Interval',
			'alarm_id' => 'Alarm',
			'state' => 'State',
			'action' => 'Action',
			'event_date' => 'Event Date',
			'trigger_date' => 'Trigger Date',
			'res_id' => 'Res',
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
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('repeat',$this->repeat);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('trigger_occurs',$this->trigger_occurs,true);
		$criteria->compare('duration',$this->duration);
		$criteria->compare('active',$this->active);
		$criteria->compare('trigger_related',$this->trigger_related,true);
		$criteria->compare('trigger_duration',$this->trigger_duration);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('attach',$this->attach,true);
		$criteria->compare('event_end_date',$this->event_end_date,true);
		$criteria->compare('trigger_interval',$this->trigger_interval,true);
		$criteria->compare('alarm_id',$this->alarm_id);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('event_date',$this->event_date,true);
		$criteria->compare('trigger_date',$this->trigger_date,true);
		$criteria->compare('res_id',$this->res_id);

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
	 * @return CalendarAlarm the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
