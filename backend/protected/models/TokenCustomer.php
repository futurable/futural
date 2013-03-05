<?php

/**
 * This is the model class for table "Token_Customer".
 *
 * The followings are the available columns in table 'Token_Customer':
 * @property integer $ID
 * @property string $Tag
 * @property string $Name
 * @property string $Street
 * @property string $City
 * @property string $Phone
 * @property string $Email
 *
 * The followings are the available model relations:
 * @property TokenKey[] $tokenKeys
 * @property TokenSettings[] $tokenSettings
 */
class TokenCustomer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Token_Customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Tag, Name', 'required'),
			array('Tag', 'length', 'max'=>16, 'min'=>2),
			array('Tag', 'unique', 'caseSensitive'=>false),
			array('Name, Street, City', 'length', 'max'=>256),
			array('Phone, Email', 'length', 'max'=>128),
			array('Email', 'email'),
			array('Tag', 'match', 'pattern'=>'(^[a-z]+$)', 'message'=>'You can only use lowercase alphabetic characters'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Tag, Name, Street, City, Phone, Email', 'safe', 'on'=>'search'),
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
			'tokenKeys' => array(self::HAS_MANY, 'TokenKey', 'Token_Customer_ID'),
			'tokenSettings' => array(self::HAS_MANY, 'TokenSettings', 'Token_Customer_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Tag' => 'Tag',
			'Name' => 'Name',
			'Street' => 'Street',
			'City' => 'City',
			'Phone' => 'Phone',
			'Email' => 'Email',
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

		$criteria->compare('Tag',$this->Tag,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Street',$this->Street,true);
		$criteria->compare('City',$this->City,true);
		$criteria->compare('Phone',$this->Phone,true);
		$criteria->compare('Email',$this->Email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TokenCustomer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
