<?php

/**
 * This is the model class for table "resource_calendar".
 *
 * The followings are the available columns in table 'resource_calendar':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $manager
 * @property string $name
 * @property integer $company_id
 *
 * The followings are the available model relations:
 * @property ProjectProject[] $projectProjects
 * @property ResUsers $writeU
 * @property ResUsers $manager0
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property ResourceResource[] $resourceResources
 * @property ResourceCalendarAttendance[] $resourceCalendarAttendances
 * @property CrmCaseSection[] $crmCaseSections
 * @property ResourceCalendarLeaves[] $resourceCalendarLeaves
 */
class ResourceCalendar extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'resource_calendar';
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
			array('create_uid, write_uid, manager, company_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, manager, name, company_id', 'safe', 'on'=>'search'),
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
			'projectProjects' => array(self::HAS_MANY, 'ProjectProject', 'resource_calendar_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'manager0' => array(self::BELONGS_TO, 'ResUsers', 'manager'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'resourceResources' => array(self::HAS_MANY, 'ResourceResource', 'calendar_id'),
			'resourceCalendarAttendances' => array(self::HAS_MANY, 'ResourceCalendarAttendance', 'calendar_id'),
			'crmCaseSections' => array(self::HAS_MANY, 'CrmCaseSection', 'resource_calendar_id'),
			'resourceCalendarLeaves' => array(self::HAS_MANY, 'ResourceCalendarLeaves', 'calendar_id'),
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
			'manager' => 'Manager',
			'name' => 'Name',
			'company_id' => 'Company',
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
		$criteria->compare('manager',$this->manager);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('company_id',$this->company_id);

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
	 * @return ResourceCalendar the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
