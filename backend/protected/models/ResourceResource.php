<?php

/**
 * This is the model class for table "resource_resource".
 *
 * The followings are the available columns in table 'resource_resource':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property double $time_efficiency
 * @property string $code
 * @property integer $user_id
 * @property string $name
 * @property integer $company_id
 * @property boolean $active
 * @property integer $calendar_id
 * @property string $resource_type
 *
 * The followings are the available model relations:
 * @property HrEmployee[] $hrEmployees
 * @property MrpWorkcenter[] $mrpWorkcenters
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property ResourceCalendar $calendar
 * @property ResourceCalendarLeaves[] $resourceCalendarLeaves
 */
class ResourceResource extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'resource_resource';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('time_efficiency, name, resource_type', 'required'),
			array('create_uid, write_uid, user_id, company_id, calendar_id', 'numerical', 'integerOnly'=>true),
			array('time_efficiency', 'numerical'),
			array('code', 'length', 'max'=>16),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, active', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, time_efficiency, code, user_id, name, company_id, active, calendar_id, resource_type', 'safe', 'on'=>'search'),
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
			'hrEmployees' => array(self::HAS_MANY, 'HrEmployee', 'resource_id'),
			'mrpWorkcenters' => array(self::HAS_MANY, 'MrpWorkcenter', 'resource_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'user' => array(self::BELONGS_TO, 'ResUsers', 'user_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'calendar' => array(self::BELONGS_TO, 'ResourceCalendar', 'calendar_id'),
			'resourceCalendarLeaves' => array(self::HAS_MANY, 'ResourceCalendarLeaves', 'resource_id'),
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
			'time_efficiency' => 'Time Efficiency',
			'code' => 'Code',
			'user_id' => 'User',
			'name' => 'Name',
			'company_id' => 'Company',
			'active' => 'Active',
			'calendar_id' => 'Calendar',
			'resource_type' => 'Resource Type',
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
		$criteria->compare('time_efficiency',$this->time_efficiency);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('active',$this->active);
		$criteria->compare('calendar_id',$this->calendar_id);
		$criteria->compare('resource_type',$this->resource_type,true);

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
	 * @return ResourceResource the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
