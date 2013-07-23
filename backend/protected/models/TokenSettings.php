<?php

/**
 * This is the model class for table "Token_Settings".
 *
 * The followings are the available columns in table 'Token_Settings':
 * @property integer $ID
 * @property string $Description
 * @property integer $CreateInitData
 * @property integer $CreateDemoData
 * @property integer $CreatePurchasingOrders
 * @property integer $Token_Customer_ID
 *
 * The followings are the available model relations:
 * @property TokenKey[] $tokenKeys
 * @property TokenCustomer $tokenCustomer
 */
class TokenSettings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Token_Settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Description, Token_Customer_ID', 'required'),
			array('CreateInitData, CreateDemoData, CreatePurchasingOrders, Token_Customer_ID', 'numerical', 'integerOnly'=>true),
			array('Description', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Description, CreateInitData, CreateDemoData, CreatePurchasingOrders, Token_Customer_ID', 'safe', 'on'=>'search'),
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
			'tokenKeys' => array(self::HAS_MANY, 'TokenKey', 'Token_Settings_ID'),
			'tokenCustomer' => array(self::BELONGS_TO, 'TokenCustomer', 'Token_Customer_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Description' => 'Description',
			'CreateInitData' => 'Create Init Data',
			'CreateDemoData' => 'Create Demo Data',
			'CreatePurchasingOrders' => 'Create Purchasing Orders',
			'Token_Customer_ID' => 'Token Customer',
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
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('CreateInitData',$this->CreateInitData);
		$criteria->compare('CreateDemoData',$this->CreateDemoData);
		$criteria->compare('CreatePurchasingOrders',$this->CreatePurchasingOrders);
		$criteria->compare('Token_Customer_ID',$this->Token_Customer_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TokenSettings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
