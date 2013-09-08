<?php

/**
 * This is the model class for table "project_task_history".
 *
 * The followings are the available columns in table 'project_task_history':
 * @property integer $id
 * @property integer $user_id
 * @property integer $task_id
 * @property string $end_date
 * @property integer $type_id
 * @property string $kanban_state
 * @property string $state
 * @property string $date
 * @property string $planned_hours
 * @property string $remaining_hours
 *
 * The followings are the available model relations:
 * @property ResUsers $user
 * @property ProjectTaskType $type
 * @property ProjectTask $task
 */
class ProjectTaskHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project_task_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('task_id', 'required'),
			array('user_id, task_id, type_id', 'numerical', 'integerOnly'=>true),
			array('end_date, kanban_state, state, date, planned_hours, remaining_hours', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, task_id, end_date, type_id, kanban_state, state, date, planned_hours, remaining_hours', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'ResUsers', 'user_id'),
			'type' => array(self::BELONGS_TO, 'ProjectTaskType', 'type_id'),
			'task' => array(self::BELONGS_TO, 'ProjectTask', 'task_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'task_id' => 'Task',
			'end_date' => 'End Date',
			'type_id' => 'Type',
			'kanban_state' => 'Kanban State',
			'state' => 'State',
			'date' => 'Date',
			'planned_hours' => 'Planned Hours',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('task_id',$this->task_id);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('kanban_state',$this->kanban_state,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('planned_hours',$this->planned_hours,true);
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
	 * @return ProjectTaskHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
