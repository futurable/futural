<?php

/**
 * This is the model class for table "calendar_attendee".
 *
 * The followings are the available columns in table 'calendar_attendee':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $cn
 * @property string $cutype
 * @property integer $partner_id
 * @property string $availability
 * @property integer $user_id
 * @property string $language
 * @property string $delegated_from
 * @property string $sent_by
 * @property string $member
 * @property string $delegated_to
 * @property string $state
 * @property string $role
 * @property string $ref
 * @property string $email
 * @property string $dir
 * @property boolean $rsvp
 *
 * The followings are the available model relations:
 * @property AlarmAttendeeRel[] $alarmAttendeeRels
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property ResPartner $partner
 * @property ResUsers $createU
 * @property EventAttendeeRel[] $eventAttendeeRels
 * @property MeetingAttendeeRel[] $meetingAttendeeRels
 * @property CalendarAttendeeParentRel[] $calendarAttendeeParentRels
 * @property CalendarAttendeeParentRel[] $calendarAttendeeParentRels1
 * @property CalendarAttendeeChildRel[] $calendarAttendeeChildRels
 * @property CalendarAttendeeChildRel[] $calendarAttendeeChildRels1
 */
class CalendarAttendee extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'calendar_attendee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_uid, write_uid, partner_id, user_id', 'numerical', 'integerOnly'=>true),
			array('cn, delegated_from, sent_by, member, delegated_to, email, dir', 'length', 'max'=>124),
			array('ref', 'length', 'max'=>128),
			array('create_date, write_date, cutype, availability, language, state, role, rsvp', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, cn, cutype, partner_id, availability, user_id, language, delegated_from, sent_by, member, delegated_to, state, role, ref, email, dir, rsvp', 'safe', 'on'=>'search'),
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
			'alarmAttendeeRels' => array(self::HAS_MANY, 'AlarmAttendeeRel', 'attendee_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'user' => array(self::BELONGS_TO, 'ResUsers', 'user_id'),
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'eventAttendeeRels' => array(self::HAS_MANY, 'EventAttendeeRel', 'attendee_id'),
			'meetingAttendeeRels' => array(self::HAS_MANY, 'MeetingAttendeeRel', 'attendee_id'),
			'calendarAttendeeParentRels' => array(self::HAS_MANY, 'CalendarAttendeeParentRel', 'parent_id'),
			'calendarAttendeeParentRels1' => array(self::HAS_MANY, 'CalendarAttendeeParentRel', 'attendee_id'),
			'calendarAttendeeChildRels' => array(self::HAS_MANY, 'CalendarAttendeeChildRel', 'child_id'),
			'calendarAttendeeChildRels1' => array(self::HAS_MANY, 'CalendarAttendeeChildRel', 'attendee_id'),
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
			'cn' => 'Cn',
			'cutype' => 'Cutype',
			'partner_id' => 'Partner',
			'availability' => 'Availability',
			'user_id' => 'User',
			'language' => 'Language',
			'delegated_from' => 'Delegated From',
			'sent_by' => 'Sent By',
			'member' => 'Member',
			'delegated_to' => 'Delegated To',
			'state' => 'State',
			'role' => 'Role',
			'ref' => 'Ref',
			'email' => 'Email',
			'dir' => 'Dir',
			'rsvp' => 'Rsvp',
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
		$criteria->compare('cn',$this->cn,true);
		$criteria->compare('cutype',$this->cutype,true);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('availability',$this->availability,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('delegated_from',$this->delegated_from,true);
		$criteria->compare('sent_by',$this->sent_by,true);
		$criteria->compare('member',$this->member,true);
		$criteria->compare('delegated_to',$this->delegated_to,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('ref',$this->ref,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('dir',$this->dir,true);
		$criteria->compare('rsvp',$this->rsvp);

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
	 * @return CalendarAttendee the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
