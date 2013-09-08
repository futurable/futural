<?php

/**
 * This is the model class for table "res_alarm".
 *
 * The followings are the available columns in table 'res_alarm':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $trigger_duration
 * @property string $name
 * @property string $trigger_occurs
 * @property string $trigger_interval
 * @property integer $duration
 * @property integer $repeat
 * @property boolean $active
 * @property string $trigger_related
 *
 * The followings are the available model relations:
 * @property CalendarEvent[] $calendarEvents
 * @property CalendarTodo[] $calendarTodos
 * @property CrmMeeting[] $crmMeetings
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property CalendarAlarm[] $calendarAlarms
 */
class ResAlarm extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'res_alarm';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('trigger_duration, name, trigger_occurs, trigger_interval, trigger_related', 'required'),
			array('create_uid, write_uid, trigger_duration, duration, repeat', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>256),
			array('create_date, write_date, active', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, trigger_duration, name, trigger_occurs, trigger_interval, duration, repeat, active, trigger_related', 'safe', 'on'=>'search'),
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
			'calendarEvents' => array(self::HAS_MANY, 'CalendarEvent', 'alarm_id'),
			'calendarTodos' => array(self::HAS_MANY, 'CalendarTodo', 'alarm_id'),
			'crmMeetings' => array(self::HAS_MANY, 'CrmMeeting', 'alarm_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'calendarAlarms' => array(self::HAS_MANY, 'CalendarAlarm', 'alarm_id'),
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
			'trigger_duration' => 'Trigger Duration',
			'name' => 'Name',
			'trigger_occurs' => 'Trigger Occurs',
			'trigger_interval' => 'Trigger Interval',
			'duration' => 'Duration',
			'repeat' => 'Repeat',
			'active' => 'Active',
			'trigger_related' => 'Trigger Related',
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
		$criteria->compare('trigger_duration',$this->trigger_duration);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('trigger_occurs',$this->trigger_occurs,true);
		$criteria->compare('trigger_interval',$this->trigger_interval,true);
		$criteria->compare('duration',$this->duration);
		$criteria->compare('repeat',$this->repeat);
		$criteria->compare('active',$this->active);
		$criteria->compare('trigger_related',$this->trigger_related,true);

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
	 * @return ResAlarm the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
