<?php

/**
 * This is the model class for table "hr_timesheet_analytic_profit".
 *
 * The followings are the available columns in table 'hr_timesheet_analytic_profit':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $date_from
 * @property string $date_to
 *
 * The followings are the available model relations:
 * @property AnalyticProfitEmpRel[] $analyticProfitEmpRels
 * @property AnalyticProfitJournalRel[] $analyticProfitJournalRels
 * @property ResUsers $writeU
 * @property ResUsers $createU
 */
class HrTimesheetAnalyticProfit extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hr_timesheet_analytic_profit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_from, date_to', 'required'),
			array('create_uid, write_uid', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, date_from, date_to', 'safe', 'on'=>'search'),
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
			'analyticProfitEmpRels' => array(self::HAS_MANY, 'AnalyticProfitEmpRel', 'analytic_id'),
			'analyticProfitJournalRels' => array(self::HAS_MANY, 'AnalyticProfitJournalRel', 'analytic_id'),
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
			'date_from' => 'Date From',
			'date_to' => 'Date To',
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
		$criteria->compare('date_from',$this->date_from,true);
		$criteria->compare('date_to',$this->date_to,true);

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
	 * @return HrTimesheetAnalyticProfit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
