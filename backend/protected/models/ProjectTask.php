<?php

/**
 * This is the model class for table "project_task".
 *
 * The followings are the available columns in table 'project_task':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $sequence
 * @property integer $color
 * @property string $date_end
 * @property string $effective_hours
 * @property double $planned_hours
 * @property integer $partner_id
 * @property integer $user_id
 * @property string $date_start
 * @property integer $company_id
 * @property string $priority
 * @property string $state
 * @property string $progress
 * @property integer $project_id
 * @property string $description
 * @property string $kanban_state
 * @property boolean $active
 * @property string $delay_hours
 * @property integer $stage_id
 * @property string $name
 * @property string $date_deadline
 * @property string $notes
 * @property string $total_hours
 * @property string $remaining_hours
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property ProjectTaskType $stage
 * @property ProjectProject $project
 * @property ResPartner $partner
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property ProjectTaskHistory[] $projectTaskHistories
 * @property ProjectTaskParentRel[] $projectTaskParentRels
 * @property ProjectTaskParentRel[] $projectTaskParentRels1
 * @property ProjectTaskWork[] $projectTaskWorks
 * @property ProjectCategoryProjectTaskRel[] $projectCategoryProjectTaskRels
 */
class ProjectTask extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project_task';
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
			array('create_uid, write_uid, sequence, color, partner_id, user_id, company_id, project_id, stage_id', 'numerical', 'integerOnly'=>true),
			array('planned_hours', 'numerical'),
			array('name', 'length', 'max'=>128),
			array('create_date, write_date, date_end, effective_hours, date_start, priority, state, progress, description, kanban_state, active, delay_hours, date_deadline, notes, total_hours, remaining_hours', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, sequence, color, date_end, effective_hours, planned_hours, partner_id, user_id, date_start, company_id, priority, state, progress, project_id, description, kanban_state, active, delay_hours, stage_id, name, date_deadline, notes, total_hours, remaining_hours', 'safe', 'on'=>'search'),
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
			'stage' => array(self::BELONGS_TO, 'ProjectTaskType', 'stage_id'),
			'project' => array(self::BELONGS_TO, 'ProjectProject', 'project_id'),
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'projectTaskHistories' => array(self::HAS_MANY, 'ProjectTaskHistory', 'task_id'),
			'projectTaskParentRels' => array(self::HAS_MANY, 'ProjectTaskParentRel', 'task_id'),
			'projectTaskParentRels1' => array(self::HAS_MANY, 'ProjectTaskParentRel', 'parent_id'),
			'projectTaskWorks' => array(self::HAS_MANY, 'ProjectTaskWork', 'task_id'),
			'projectCategoryProjectTaskRels' => array(self::HAS_MANY, 'ProjectCategoryProjectTaskRel', 'project_task_id'),
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
			'sequence' => 'Sequence',
			'color' => 'Color',
			'date_end' => 'Date End',
			'effective_hours' => 'Effective Hours',
			'planned_hours' => 'Planned Hours',
			'partner_id' => 'Partner',
			'user_id' => 'User',
			'date_start' => 'Date Start',
			'company_id' => 'Company',
			'priority' => 'Priority',
			'state' => 'State',
			'progress' => 'Progress',
			'project_id' => 'Project',
			'description' => 'Description',
			'kanban_state' => 'Kanban State',
			'active' => 'Active',
			'delay_hours' => 'Delay Hours',
			'stage_id' => 'Stage',
			'name' => 'Name',
			'date_deadline' => 'Date Deadline',
			'notes' => 'Notes',
			'total_hours' => 'Total Hours',
			'remaining_hours' => 'Remaining Hours',
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
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('color',$this->color);
		$criteria->compare('date_end',$this->date_end,true);
		$criteria->compare('effective_hours',$this->effective_hours,true);
		$criteria->compare('planned_hours',$this->planned_hours);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('date_start',$this->date_start,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('priority',$this->priority,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('progress',$this->progress,true);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('kanban_state',$this->kanban_state,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('delay_hours',$this->delay_hours,true);
		$criteria->compare('stage_id',$this->stage_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('date_deadline',$this->date_deadline,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('total_hours',$this->total_hours,true);
		$criteria->compare('remaining_hours',$this->remaining_hours,true);

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
	 * @return ProjectTask the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
