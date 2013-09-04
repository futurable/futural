<?php

/**
 * This is the model class for table "account_installer".
 *
 * The followings are the available columns in table 'account_installer':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $date_stop
 * @property string $charts
 * @property integer $company_id
 * @property string $date_start
 * @property string $period
 * @property boolean $has_default_company
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property ResCompany $company
 */
class AccountInstaller extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_installer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_stop, charts, company_id, date_start, period', 'required'),
			array('create_uid, write_uid, company_id', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date, has_default_company', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, date_stop, charts, company_id, date_start, period, has_default_company', 'safe', 'on'=>'search'),
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
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
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
			'date_stop' => 'Date Stop',
			'charts' => 'Charts',
			'company_id' => 'Company',
			'date_start' => 'Date Start',
			'period' => 'Period',
			'has_default_company' => 'Has Default Company',
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
		$criteria->compare('date_stop',$this->date_stop,true);
		$criteria->compare('charts',$this->charts,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('date_start',$this->date_start,true);
		$criteria->compare('period',$this->period,true);
		$criteria->compare('has_default_company',$this->has_default_company);

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
	 * @return AccountInstaller the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
