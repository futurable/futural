<?php

/**
 * This is the model class for table "project_task_type".
 *
 * The followings are the available columns in table 'project_task_type':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property boolean $fold
 * @property boolean $case_default
 * @property string $name
 * @property integer $sequence
 * @property string $state
 * @property string $description
 *
 * The followings are the available model relations:
 * @property ProjectTask[] $projectTasks
 * @property ProjectTaskHistory[] $projectTaskHistories
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property ProjectTaskTypeRel[] $projectTaskTypeRels
 */
class ProjectTaskType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project_task_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, state', 'required'),
			array('create_uid, write_uid, sequence', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, fold, case_default, description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, fold, case_default, name, sequence, state, description', 'safe', 'on'=>'search'),
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
			'projectTasks' => array(self::HAS_MANY, 'ProjectTask', 'stage_id'),
			'projectTaskHistories' => array(self::HAS_MANY, 'ProjectTaskHistory', 'type_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'projectTaskTypeRels' => array(self::HAS_MANY, 'ProjectTaskTypeRel', 'type_id'),
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
			'fold' => 'Fold',
			'case_default' => 'Case Default',
			'name' => 'Name',
			'sequence' => 'Sequence',
			'state' => 'State',
			'description' => 'Description',
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
		$criteria->compare('fold',$this->fold);
		$criteria->compare('case_default',$this->case_default);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('description',$this->description,true);

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
	 * @return ProjectTaskType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
