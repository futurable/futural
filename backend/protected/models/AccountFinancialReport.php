<?php

/**
 * This is the model class for table "account_financial_report".
 *
 * The followings are the available columns in table 'account_financial_report':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $parent_id
 * @property string $name
 * @property integer $sequence
 * @property integer $level
 * @property integer $style_overwrite
 * @property integer $sign
 * @property integer $account_report_id
 * @property string $display_detail
 * @property string $type
 *
 * The followings are the available model relations:
 * @property AccountAccountFinancialReport[] $accountAccountFinancialReports
 * @property AccountTemplateFinancialReport[] $accountTemplateFinancialReports
 * @property AccountingReport[] $accountingReports
 * @property AccountAccountFinancialReportType[] $accountAccountFinancialReportTypes
 * @property ResUsers $writeU
 * @property AccountFinancialReport $parent
 * @property AccountFinancialReport[] $accountFinancialReports
 * @property ResUsers $createU
 * @property AccountFinancialReport $accountReport
 * @property AccountFinancialReport[] $accountFinancialReports1
 */
class AccountFinancialReport extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_financial_report';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, sign', 'required'),
			array('create_uid, write_uid, parent_id, sequence, level, style_overwrite, sign, account_report_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			array('create_date, write_date, display_detail, type', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, parent_id, name, sequence, level, style_overwrite, sign, account_report_id, display_detail, type', 'safe', 'on'=>'search'),
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
			'accountAccountFinancialReports' => array(self::HAS_MANY, 'AccountAccountFinancialReport', 'report_line_id'),
			'accountTemplateFinancialReports' => array(self::HAS_MANY, 'AccountTemplateFinancialReport', 'report_line_id'),
			'accountingReports' => array(self::HAS_MANY, 'AccountingReport', 'account_report_id'),
			'accountAccountFinancialReportTypes' => array(self::HAS_MANY, 'AccountAccountFinancialReportType', 'report_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'parent' => array(self::BELONGS_TO, 'AccountFinancialReport', 'parent_id'),
			'accountFinancialReports' => array(self::HAS_MANY, 'AccountFinancialReport', 'parent_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'accountReport' => array(self::BELONGS_TO, 'AccountFinancialReport', 'account_report_id'),
			'accountFinancialReports1' => array(self::HAS_MANY, 'AccountFinancialReport', 'account_report_id'),
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
			'parent_id' => 'Parent',
			'name' => 'Name',
			'sequence' => 'Sequence',
			'level' => 'Level',
			'style_overwrite' => 'Style Overwrite',
			'sign' => 'Sign',
			'account_report_id' => 'Account Report',
			'display_detail' => 'Display Detail',
			'type' => 'Type',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('level',$this->level);
		$criteria->compare('style_overwrite',$this->style_overwrite);
		$criteria->compare('sign',$this->sign);
		$criteria->compare('account_report_id',$this->account_report_id);
		$criteria->compare('display_detail',$this->display_detail,true);
		$criteria->compare('type',$this->type,true);

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
	 * @return AccountFinancialReport the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
