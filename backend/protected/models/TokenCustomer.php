<?php

/**
 * This is the model class for table "token_customer".
 *
 * The followings are the available columns in table 'token_customer':
 * @property integer $id
 * @property string $tag
 * @property string $name
 * @property string $street
 * @property integer $postal_code
 * @property string $city
 * @property string $phone
 * @property string $email
 *
 * The followings are the available model relations:
 * @property OrderSetup[] $orderSetups
 * @property TokenKey[] $tokenKeys
 * @property TokenSetup[] $tokenSetups
 * @property User[] $users
 */
class TokenCustomer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'token_customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tag, name, postal_code', 'required'),
			array('postal_code', 'numerical', 'integerOnly'=>true),
			array('tag', 'length', 'max'=>32),
			array('name, street, city, email', 'length', 'max'=>256),
			array('phone', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tag, name, street, postal_code, city, phone, email', 'safe', 'on'=>'search'),
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
			'orderSetups' => array(self::HAS_MANY, 'OrderSetup', 'token_customer_id'),
			'tokenKeys' => array(self::HAS_MANY, 'TokenKey', 'token_customer_id'),
			'tokenSetups' => array(self::HAS_MANY, 'TokenSetup', 'token_customer_id'),
			'users' => array(self::HAS_MANY, 'User', 'token_customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tag' => 'Tag',
			'name' => 'Name',
			'street' => 'Street',
			'postal_code' => 'Postal Code',
			'city' => 'City',
			'phone' => 'Phone',
			'email' => 'Email',
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
		$criteria->compare('tag',$this->tag,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('postal_code',$this->postal_code);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);

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
