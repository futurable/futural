<?php

/**
 * This is the model class for table "hr_config_settings".
 *
 * The followings are the available columns in table 'hr_config_settings':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property boolean $module_hr_contract
 * @property boolean $module_hr_holidays
 * @property boolean $module_hr_timesheet
 * @property boolean $module_hr_payroll
 * @property boolean $module_hr_timesheet_sheet
 * @property boolean $module_hr_attendance
 * @property boolean $module_hr_evaluation
 * @property boolean $module_account_analytic_analysis
 * @property boolean $module_hr_expense
 * @property boolean $module_hr_recruitment
 * @property boolean $group_hr_attendance
 * @property string $timesheet_range
 * @property double $timesheet_max_difference
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ResUsers $createU
 */
class HrConfigSettings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hr_config_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_uid, write_uid', 'numerical', 'integerOnly'=>true),
			array('timesheet_max_difference', 'numerical'),
			array('create_date, write_date, module_hr_contract, module_hr_holidays, module_hr_timesheet, module_hr_payroll, module_hr_timesheet_sheet, module_hr_attendance, module_hr_evaluation, module_account_analytic_analysis, module_hr_expense, module_hr_recruitment, group_hr_attendance, timesheet_range', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, module_hr_contract, module_hr_holidays, module_hr_timesheet, module_hr_payroll, module_hr_timesheet_sheet, module_hr_attendance, module_hr_evaluation, module_account_analytic_analysis, module_hr_expense, module_hr_recruitment, group_hr_attendance, timesheet_range, timesheet_max_difference', 'safe', 'on'=>'search'),
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
			'module_hr_contract' => 'Module Hr Contract',
			'module_hr_holidays' => 'Module Hr Holidays',
			'module_hr_timesheet' => 'Module Hr Timesheet',
			'module_hr_payroll' => 'Module Hr Payroll',
			'module_hr_timesheet_sheet' => 'Module Hr Timesheet Sheet',
			'module_hr_attendance' => 'Module Hr Attendance',
			'module_hr_evaluation' => 'Module Hr Evaluation',
			'module_account_analytic_analysis' => 'Module Account Analytic Analysis',
			'module_hr_expense' => 'Module Hr Expense',
			'module_hr_recruitment' => 'Module Hr Recruitment',
			'group_hr_attendance' => 'Group Hr Attendance',
			'timesheet_range' => 'Timesheet Range',
			'timesheet_max_difference' => 'Timesheet Max Difference',
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
		$criteria->compare('module_hr_contract',$this->module_hr_contract);
		$criteria->compare('module_hr_holidays',$this->module_hr_holidays);
		$criteria->compare('module_hr_timesheet',$this->module_hr_timesheet);
		$criteria->compare('module_hr_payroll',$this->module_hr_payroll);
		$criteria->compare('module_hr_timesheet_sheet',$this->module_hr_timesheet_sheet);
		$criteria->compare('module_hr_attendance',$this->module_hr_attendance);
		$criteria->compare('module_hr_evaluation',$this->module_hr_evaluation);
		$criteria->compare('module_account_analytic_analysis',$this->module_account_analytic_analysis);
		$criteria->compare('module_hr_expense',$this->module_hr_expense);
		$criteria->compare('module_hr_recruitment',$this->module_hr_recruitment);
		$criteria->compare('group_hr_attendance',$this->group_hr_attendance);
		$criteria->compare('timesheet_range',$this->timesheet_range,true);
		$criteria->compare('timesheet_max_difference',$this->timesheet_max_difference);

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
	 * @return HrConfigSettings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
