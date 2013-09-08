<?php

/**
 * This is the model class for table "account_fiscalyear_close".
 *
 * The followings are the available columns in table 'account_fiscalyear_close':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $fy_id
 * @property integer $fy2_id
 * @property integer $period_id
 * @property integer $journal_id
 * @property string $report_name
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property AccountPeriod $period
 * @property AccountJournal $journal
 * @property AccountFiscalyear $fy
 * @property AccountFiscalyear $fy2
 * @property ResUsers $createU
 */
class AccountFiscalyearClose extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_fiscalyear_close';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fy_id, fy2_id, period_id, journal_id, report_name', 'required'),
			array('create_uid, write_uid, fy_id, fy2_id, period_id, journal_id', 'numerical', 'integerOnly'=>true),
			array('report_name', 'length', 'max'=>64),
			array('create_date, write_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, fy_id, fy2_id, period_id, journal_id, report_name', 'safe', 'on'=>'search'),
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
			'period' => array(self::BELONGS_TO, 'AccountPeriod', 'period_id'),
			'journal' => array(self::BELONGS_TO, 'AccountJournal', 'journal_id'),
			'fy' => array(self::BELONGS_TO, 'AccountFiscalyear', 'fy_id'),
			'fy2' => array(self::BELONGS_TO, 'AccountFiscalyear', 'fy2_id'),
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
			'fy_id' => 'Fy',
			'fy2_id' => 'Fy2',
			'period_id' => 'Period',
			'journal_id' => 'Journal',
			'report_name' => 'Report Name',
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
		$criteria->compare('fy_id',$this->fy_id);
		$criteria->compare('fy2_id',$this->fy2_id);
		$criteria->compare('period_id',$this->period_id);
		$criteria->compare('journal_id',$this->journal_id);
		$criteria->compare('report_name',$this->report_name,true);

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
	 * @return AccountFiscalyearClose the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
