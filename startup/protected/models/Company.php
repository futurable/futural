<?php

/**
 * This is the model class for table "company".
 *
 * The followings are the available columns in table 'company':
 * @property integer $id
 * @property string $company_name
 * @property integer $token_key_id
 * @property integer $industry_id
 * @property integer $costbenefit_calculation_id
 *
 * The followings are the available model relations:
 * @property TokenKey $tokenKey
 * @property Industry $industry
 * @property CostbenefitCalculation $costbenefitCalculation
 */
class Company extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_name, token_key_id, industry_id, costbenefit_calculation_id', 'required'),
			array('token_key_id, industry_id, costbenefit_calculation_id', 'numerical', 'integerOnly'=>true),
			array('company_name', 'length', 'max'=>256),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, company_name, token_key_id, industry_id, costbenefit_calculation_id', 'safe', 'on'=>'search'),
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
			'tokenKey' => array(self::BELONGS_TO, 'TokenKey', 'token_key_id'),
			'industry' => array(self::BELONGS_TO, 'Industry', 'industry_id'),
			'costbenefitCalculation' => array(self::BELONGS_TO, 'CostbenefitCalculation', 'costbenefit_calculation_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'company_name' => 'Company Name',
			'token_key_id' => 'Token Key',
			'industry_id' => 'Industry',
			'costbenefit_calculation_id' => 'Costbenefit Calculation',
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
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('token_key_id',$this->token_key_id);
		$criteria->compare('industry_id',$this->industry_id);
		$criteria->compare('costbenefit_calculation_id',$this->costbenefit_calculation_id);

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
