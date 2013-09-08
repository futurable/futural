<?php

/**
 * This is the model class for table "project_task_delegate".
 *
 * The followings are the available columns in table 'project_task_delegate':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property double $planned_hours
 * @property integer $user_id
 * @property string $name
 * @property string $state
 * @property integer $project_id
 * @property string $prefix
 * @property double $planned_hours_me
 * @property string $new_task_description
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property ProjectProject $project
 * @property ResUsers $createU
 */
class ProjectTaskDelegate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project_task_delegate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, name', 'required'),
			array('create_uid, write_uid, user_id, project_id', 'numerical', 'integerOnly'=>true),
			array('planned_hours, planned_hours_me', 'numerical'),
			array('name, prefix', 'length', 'max'=>64),
			array('create_date, write_date, state, new_task_description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, planned_hours, user_id, name, state, project_id, prefix, planned_hours_me, new_task_description', 'safe', 'on'=>'search'),
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
			'project' => array(self::BELONGS_TO, 'ProjectProject', 'project_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
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
			'planned_hours' => 'Planned Hours',
			'user_id' => 'User',
			'name' => 'Name',
			'state' => 'State',
			'project_id' => 'Project',
			'prefix' => 'Prefix',
			'planned_hours_me' => 'Planned Hours Me',
			'new_task_description' => 'New Task Description',
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
		$criteria->compare('planned_hours',$this->planned_hours);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('prefix',$this->prefix,true);
		$criteria->compare('planned_hours_me',$this->planned_hours_me);
		$criteria->compare('new_task_description',$this->new_task_description,true);

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
	 * @return ProjectTaskDelegate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
