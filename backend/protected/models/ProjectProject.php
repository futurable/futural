<?php

/**
 * This is the model class for table "project_project".
 *
 * The followings are the available columns in table 'project_project':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $alias_model
 * @property integer $color
 * @property integer $alias_id
 * @property boolean $active
 * @property string $effective_hours
 * @property string $planned_hours
 * @property string $privacy_visibility
 * @property integer $analytic_account_id
 * @property integer $sequence
 * @property integer $priority
 * @property string $total_hours
 * @property string $state
 * @property integer $resource_calendar_id
 * @property string $progress_rate
 *
 * The followings are the available model relations:
 * @property ProjectTask[] $projectTasks
 * @property ResUsers $writeU
 * @property ResourceCalendar $resourceCalendar
 * @property ResUsers $createU
 * @property AccountAnalyticAccount $analyticAccount
 * @property MailAlias $alias
 * @property ProjectUserRel[] $projectUserRels
 * @property ProjectTaskTypeRel[] $projectTaskTypeRels
 * @property ProjectTaskDelegate[] $projectTaskDelegates
 */
class ProjectProject extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project_project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('alias_model, alias_id, privacy_visibility, analytic_account_id, state', 'required'),
			array('create_uid, write_uid, color, alias_id, analytic_account_id, sequence, priority, resource_calendar_id', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date, active, effective_hours, planned_hours, total_hours, progress_rate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, alias_model, color, alias_id, active, effective_hours, planned_hours, privacy_visibility, analytic_account_id, sequence, priority, total_hours, state, resource_calendar_id, progress_rate', 'safe', 'on'=>'search'),
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
			'projectTasks' => array(self::HAS_MANY, 'ProjectTask', 'project_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'resourceCalendar' => array(self::BELONGS_TO, 'ResourceCalendar', 'resource_calendar_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'analyticAccount' => array(self::BELONGS_TO, 'AccountAnalyticAccount', 'analytic_account_id'),
			'alias' => array(self::BELONGS_TO, 'MailAlias', 'alias_id'),
			'projectUserRels' => array(self::HAS_MANY, 'ProjectUserRel', 'project_id'),
			'projectTaskTypeRels' => array(self::HAS_MANY, 'ProjectTaskTypeRel', 'project_id'),
			'projectTaskDelegates' => array(self::HAS_MANY, 'ProjectTaskDelegate', 'project_id'),
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
			'alias_model' => 'Alias Model',
			'color' => 'Color',
			'alias_id' => 'Alias',
			'active' => 'Active',
			'effective_hours' => 'Effective Hours',
			'planned_hours' => 'Planned Hours',
			'privacy_visibility' => 'Privacy Visibility',
			'analytic_account_id' => 'Analytic Account',
			'sequence' => 'Sequence',
			'priority' => 'Priority',
			'total_hours' => 'Total Hours',
			'state' => 'State',
			'resource_calendar_id' => 'Resource Calendar',
			'progress_rate' => 'Progress Rate',
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
		$criteria->compare('alias_model',$this->alias_model,true);
		$criteria->compare('color',$this->color);
		$criteria->compare('alias_id',$this->alias_id);
		$criteria->compare('active',$this->active);
		$criteria->compare('effective_hours',$this->effective_hours,true);
		$criteria->compare('planned_hours',$this->planned_hours,true);
		$criteria->compare('privacy_visibility',$this->privacy_visibility,true);
		$criteria->compare('analytic_account_id',$this->analytic_account_id);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('total_hours',$this->total_hours,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('resource_calendar_id',$this->resource_calendar_id);
		$criteria->compare('progress_rate',$this->progress_rate,true);

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
	 * @return ProjectProject the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
