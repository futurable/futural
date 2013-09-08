<?php

/**
 * This is the model class for table "project_config_settings".
 *
 * The followings are the available columns in table 'project_config_settings':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property boolean $group_manage_delegation_task
 * @property boolean $module_pad
 * @property boolean $module_project_mrp
 * @property boolean $module_project_issue_sheet
 * @property boolean $group_tasks_work_on_tasks
 * @property boolean $module_project_long_term
 * @property integer $time_unit
 * @property boolean $module_project_issue
 * @property boolean $group_time_work_estimation_tasks
 * @property boolean $module_project_timesheet
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ProductUom $timeUnit
 * @property ResUsers $createU
 */
class ProjectConfigSettings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project_config_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('time_unit', 'required'),
			array('create_uid, write_uid, time_unit', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date, group_manage_delegation_task, module_pad, module_project_mrp, module_project_issue_sheet, group_tasks_work_on_tasks, module_project_long_term, module_project_issue, group_time_work_estimation_tasks, module_project_timesheet', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, group_manage_delegation_task, module_pad, module_project_mrp, module_project_issue_sheet, group_tasks_work_on_tasks, module_project_long_term, time_unit, module_project_issue, group_time_work_estimation_tasks, module_project_timesheet', 'safe', 'on'=>'search'),
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
			'timeUnit' => array(self::BELONGS_TO, 'ProductUom', 'time_unit'),
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
			'group_manage_delegation_task' => 'Group Manage Delegation Task',
			'module_pad' => 'Module Pad',
			'module_project_mrp' => 'Module Project Mrp',
			'module_project_issue_sheet' => 'Module Project Issue Sheet',
			'group_tasks_work_on_tasks' => 'Group Tasks Work On Tasks',
			'module_project_long_term' => 'Module Project Long Term',
			'time_unit' => 'Time Unit',
			'module_project_issue' => 'Module Project Issue',
			'group_time_work_estimation_tasks' => 'Group Time Work Estimation Tasks',
			'module_project_timesheet' => 'Module Project Timesheet',
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
		$criteria->compare('group_manage_delegation_task',$this->group_manage_delegation_task);
		$criteria->compare('module_pad',$this->module_pad);
		$criteria->compare('module_project_mrp',$this->module_project_mrp);
		$criteria->compare('module_project_issue_sheet',$this->module_project_issue_sheet);
		$criteria->compare('group_tasks_work_on_tasks',$this->group_tasks_work_on_tasks);
		$criteria->compare('module_project_long_term',$this->module_project_long_term);
		$criteria->compare('time_unit',$this->time_unit);
		$criteria->compare('module_project_issue',$this->module_project_issue);
		$criteria->compare('group_time_work_estimation_tasks',$this->group_time_work_estimation_tasks);
		$criteria->compare('module_project_timesheet',$this->module_project_timesheet);

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
	 * @return ProjectConfigSettings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
