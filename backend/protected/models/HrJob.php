<?php

/**
 * This is the model class for table "hr_job".
 *
 * The followings are the available columns in table 'hr_job':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $requirements
 * @property string $name
 * @property string $description
 * @property integer $company_id
 * @property string $state
 * @property double $no_of_recruitment
 * @property string $expected_employees
 * @property string $no_of_employee
 * @property integer $department_id
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property HrDepartment $department
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property HrEmployee[] $hrEmployees
 */
class HrJob extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hr_job';
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
			array('create_uid, write_uid, company_id, department_id', 'numerical', 'integerOnly'=>true),
			array('no_of_recruitment', 'numerical'),
			array('name', 'length', 'max'=>128),
			array('create_date, write_date, requirements, description, expected_employees, no_of_employee', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, requirements, name, description, company_id, state, no_of_recruitment, expected_employees, no_of_employee, department_id', 'safe', 'on'=>'search'),
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
			'department' => array(self::BELONGS_TO, 'HrDepartment', 'department_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'hrEmployees' => array(self::HAS_MANY, 'HrEmployee', 'job_id'),
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
			'requirements' => 'Requirements',
			'name' => 'Name',
			'description' => 'Description',
			'company_id' => 'Company',
			'state' => 'State',
			'no_of_recruitment' => 'No Of Recruitment',
			'expected_employees' => 'Expected Employees',
			'no_of_employee' => 'No Of Employee',
			'department_id' => 'Department',
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
		$criteria->compare('requirements',$this->requirements,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('no_of_recruitment',$this->no_of_recruitment);
		$criteria->compare('expected_employees',$this->expected_employees,true);
		$criteria->compare('no_of_employee',$this->no_of_employee,true);
		$criteria->compare('department_id',$this->department_id);

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
	 * @return HrJob the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
