<?php

/**
 * This is the model class for table "hr_employee".
 *
 * The followings are the available columns in table 'hr_employee':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $address_id
 * @property integer $coach_id
 * @property integer $resource_id
 * @property integer $color
 * @property string $image
 * @property string $marital
 * @property string $identification_id
 * @property integer $bank_account_id
 * @property integer $job_id
 * @property string $work_phone
 * @property integer $country_id
 * @property integer $parent_id
 * @property string $notes
 * @property integer $department_id
 * @property string $otherid
 * @property string $mobile_phone
 * @property string $birthday
 * @property string $sinid
 * @property string $work_email
 * @property string $work_location
 * @property string $image_medium
 * @property string $name_related
 * @property string $ssnid
 * @property string $image_small
 * @property integer $address_home_id
 * @property string $gender
 * @property string $passport_id
 * @property integer $uom_id
 * @property integer $journal_id
 * @property integer $product_id
 *
 * The followings are the available model relations:
 * @property EmployeeCategoryRel[] $employeeCategoryRels
 * @property HrSignInProject[] $hrSignInProjects
 * @property ResUsers $writeU
 * @property ResourceResource $resource
 * @property ProductProduct $product
 * @property HrEmployee $parent
 * @property HrEmployee[] $hrEmployees
 * @property AccountAnalyticJournal $journal
 * @property HrJob $job
 * @property HrDepartment $department
 * @property ResUsers $createU
 * @property ResCountry $country
 * @property HrEmployee $coach
 * @property HrEmployee[] $hrEmployees1
 * @property ResPartnerBank $bankAccount
 * @property ResPartner $address
 * @property ResPartner $addressHome
 * @property HrSignOutProject[] $hrSignOutProjects
 * @property HrDepartment[] $hrDepartments
 * @property HrTimesheetSheetSheet[] $hrTimesheetSheetSheets
 * @property TimesheetEmployeeRel[] $timesheetEmployeeRels
 * @property HrAnalyticalTimesheetEmployee[] $hrAnalyticalTimesheetEmployees
 * @property HrAttendance[] $hrAttendances
 */
class HrEmployee extends ActiveRecord
{
    public $purchaseOrdersCreated;
    public $saleOrdersCreated;
    
    public function getDbConnection()
    {
        return self::getOpenerpDbConnection();
    }
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hr_employee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('resource_id', 'required'),
			array('create_uid, write_uid, address_id, coach_id, resource_id, color, bank_account_id, job_id, country_id, parent_id, department_id, address_home_id, uom_id, journal_id, product_id', 'numerical', 'integerOnly'=>true),
			array('identification_id, work_phone, mobile_phone, sinid, work_location, ssnid', 'length', 'max'=>32),
			array('otherid, passport_id', 'length', 'max'=>64),
			array('work_email', 'length', 'max'=>240),
			array('create_date, write_date, image, marital, notes, birthday, image_medium, name_related, image_small, gender', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, address_id, coach_id, resource_id, color, image, marital, identification_id, bank_account_id, job_id, work_phone, country_id, parent_id, notes, department_id, otherid, mobile_phone, birthday, sinid, work_email, work_location, image_medium, name_related, ssnid, image_small, address_home_id, gender, passport_id, uom_id, journal_id, product_id', 'safe', 'on'=>'search'),
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
			'employeeCategoryRels' => array(self::HAS_MANY, 'EmployeeCategoryRel', 'emp_id'),
			'hrSignInProjects' => array(self::HAS_MANY, 'HrSignInProject', 'emp_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'resource' => array(self::BELONGS_TO, 'ResourceResource', 'resource_id'),
			'product' => array(self::BELONGS_TO, 'ProductProduct', 'product_id'),
			'parent' => array(self::BELONGS_TO, 'HrEmployee', 'parent_id'),
			'hrEmployees' => array(self::HAS_MANY, 'HrEmployee', 'parent_id'),
			'journal' => array(self::BELONGS_TO, 'AccountAnalyticJournal', 'journal_id'),
			'job' => array(self::BELONGS_TO, 'HrJob', 'job_id'),
			'department' => array(self::BELONGS_TO, 'HrDepartment', 'department_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'country' => array(self::BELONGS_TO, 'ResCountry', 'country_id'),
			'coach' => array(self::BELONGS_TO, 'HrEmployee', 'coach_id'),
			'hrEmployees1' => array(self::HAS_MANY, 'HrEmployee', 'coach_id'),
			'bankAccount' => array(self::BELONGS_TO, 'ResPartnerBank', 'bank_account_id'),
			'address' => array(self::BELONGS_TO, 'ResPartner', 'address_id'),
			'addressHome' => array(self::BELONGS_TO, 'ResPartner', 'address_home_id'),
			'hrSignOutProjects' => array(self::HAS_MANY, 'HrSignOutProject', 'emp_id'),
			'hrDepartments' => array(self::HAS_MANY, 'HrDepartment', 'manager_id'),
			'hrTimesheetSheetSheets' => array(self::HAS_MANY, 'HrTimesheetSheetSheet', 'employee_id'),
			'timesheetEmployeeRels' => array(self::HAS_MANY, 'TimesheetEmployeeRel', 'employee_id'),
			'hrAnalyticalTimesheetEmployees' => array(self::HAS_MANY, 'HrAnalyticalTimesheetEmployee', 'employee_id'),
			'hrAttendances' => array(self::HAS_MANY, 'HrAttendance', 'employee_id'),
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
			'address_id' => 'Address',
			'coach_id' => 'Coach',
			'resource_id' => 'Resource',
			'color' => 'Color',
			'image' => 'Image',
			'marital' => 'Marital',
			'identification_id' => 'Identification',
			'bank_account_id' => 'Bank Account',
			'job_id' => 'Job',
			'work_phone' => 'Work Phone',
			'country_id' => 'Country',
			'parent_id' => 'Parent',
			'notes' => 'Notes',
			'department_id' => 'Department',
			'otherid' => 'Otherid',
			'mobile_phone' => 'Mobile Phone',
			'birthday' => 'Birthday',
			'sinid' => 'Sinid',
			'work_email' => 'Work Email',
			'work_location' => 'Work Location',
			'image_medium' => 'Image Medium',
			'name_related' => 'Name Related',
			'ssnid' => 'Ssnid',
			'image_small' => 'Image Small',
			'address_home_id' => 'Address Home',
			'gender' => 'Gender',
			'passport_id' => 'Passport',
			'uom_id' => 'Uom',
			'journal_id' => 'Journal',
			'product_id' => 'Product',
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
		$criteria->compare('address_id',$this->address_id);
		$criteria->compare('coach_id',$this->coach_id);
		$criteria->compare('resource_id',$this->resource_id);
		$criteria->compare('color',$this->color);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('marital',$this->marital,true);
		$criteria->compare('identification_id',$this->identification_id,true);
		$criteria->compare('bank_account_id',$this->bank_account_id);
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('work_phone',$this->work_phone,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('otherid',$this->otherid,true);
		$criteria->compare('mobile_phone',$this->mobile_phone,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('sinid',$this->sinid,true);
		$criteria->compare('work_email',$this->work_email,true);
		$criteria->compare('work_location',$this->work_location,true);
		$criteria->compare('image_medium',$this->image_medium,true);
		$criteria->compare('name_related',$this->name_related,true);
		$criteria->compare('ssnid',$this->ssnid,true);
		$criteria->compare('image_small',$this->image_small,true);
		$criteria->compare('address_home_id',$this->address_home_id);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('passport_id',$this->passport_id,true);
		$criteria->compare('uom_id',$this->uom_id);
		$criteria->compare('journal_id',$this->journal_id);
		$criteria->compare('product_id',$this->product_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HrEmployee the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
