<?php

/**
 * This is the model class for table "Company".
 *
 * The followings are the available columns in table 'Company':
 * @property integer $ID
 * @property string $CompanyName
 * @property integer $Industry_ID
 * @property integer $Token_Key_ID
 *
 * The followings are the available model relations:
 * @property Industry $industry
 * @property TokenKeyTmp $tokenKey
 * @property CostBenefitCalculation[] $costBenefitCalculations
 */
class Company extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CompanyName, Industry_ID, Token_Key_ID', 'required'),
			array('Industry_ID, Token_Key_ID', 'numerical', 'integerOnly'=>true),
			array('CompanyName', 'length', 'max'=>256),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, CompanyName, Industry_ID, Token_Key_ID', 'safe', 'on'=>'search'),
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
			'industry' => array(self::BELONGS_TO, 'Industry', 'Industry_ID'),
			'tokenKey' => array(self::BELONGS_TO, 'TokenKeyTmp', 'Token_Key_ID'),
			'costBenefitCalculations' => array(self::HAS_MANY, 'CostBenefitCalculation', 'Company_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'CompanyName' => 'Company Name',
			'Industry_ID' => 'Industry',
			'Token_Key_ID' => 'Token Key',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('CompanyName',$this->CompanyName,true);
		$criteria->compare('Industry_ID',$this->Industry_ID);
		$criteria->compare('Token_Key_ID',$this->Token_Key_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Company the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
