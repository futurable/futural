<?php

/**
 * This is the model class for table "company".
 *
 * The followings are the available columns in table 'company':
 * @property integer $id
 * @property string $name
 * @property string $tag
 * @property string $business_id
 * @property string $email
 * @property integer $employees
 * @property integer $token_key_id
 * @property integer $industry_id
 *
 * The followings are the available model relations:
 * @property Industry $industry
 * @property TokenKey $tokenKey
 * @property CostbenefitCalculation[] $costbenefitCalculations
 * @property Order[] $orders
 */
class Company extends CActiveRecord
{
    public $form_step;
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
			array('name, tag, email, employees, token_key_id, industry_id', 'required'),
            array('name, tag', 'unique'),
            array('name', 'length', 'min'=>'3'),
			array('employees, token_key_id, industry_id', 'numerical', 'integerOnly'=>true),
			array('name, email', 'length', 'max'=>256),
            array('email', 'email', 'message'=>Yii::t('Company', 'EmailIsInvalid')),
			array('tag', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, tag, email, employees, token_key_id, industry_id', 'safe', 'on'=>'search'),
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
			'industry' => array(self::BELONGS_TO, 'Industry', 'industry_id'),
			'tokenKey' => array(self::BELONGS_TO, 'TokenKey', 'token_key_id'),
			'costbenefitCalculations' => array(self::HAS_MANY, 'CostbenefitCalculation', 'company_id'),
			'orders' => array(self::HAS_MANY, 'Order', 'company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('Company', 'ID'),
			'name' => Yii::t('Company', 'Name'),
			'tag' => Yii::t('Company', 'Tag'),
            'business_id' => Yii::t('Company', 'BusinessId'),
			'email' => Yii::t('Company', 'Email'),
			'employees' => Yii::t('Company', 'Employees'),
			'token_key_id' => Yii::t('Company', 'TokenKey'),
			'industry_id' => Yii::t('Company', 'Industry'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('tag',$this->tag,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('employees',$this->employees);
		$criteria->compare('token_key_id',$this->token_key_id);
		$criteria->compare('industry_id',$this->industry_id);

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
