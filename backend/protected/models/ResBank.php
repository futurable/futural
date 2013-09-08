<?php

/**
 * This is the model class for table "res_bank".
 *
 * The followings are the available columns in table 'res_bank':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $city
 * @property string $fax
 * @property string $name
 * @property string $zip
 * @property integer $country
 * @property string $street2
 * @property string $bic
 * @property string $phone
 * @property integer $state
 * @property string $street
 * @property boolean $active
 * @property string $email
 *
 * The followings are the available model relations:
 * @property ResPartnerBank[] $resPartnerBanks
 * @property ResUsers $writeU
 * @property ResCountryState $state0
 * @property ResUsers $createU
 * @property ResCountry $country0
 */
class ResBank extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'res_bank';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('create_uid, write_uid, country, state', 'numerical', 'integerOnly'=>true),
			array('city, name, street2, street', 'length', 'max'=>128),
			array('fax, bic, phone, email', 'length', 'max'=>64),
			array('zip', 'length', 'max'=>24),
			array('create_date, write_date, active', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, city, fax, name, zip, country, street2, bic, phone, state, street, active, email', 'safe', 'on'=>'search'),
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
			'resPartnerBanks' => array(self::HAS_MANY, 'ResPartnerBank', 'bank'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'state0' => array(self::BELONGS_TO, 'ResCountryState', 'state'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'country0' => array(self::BELONGS_TO, 'ResCountry', 'country'),
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
			'city' => 'City',
			'fax' => 'Fax',
			'name' => 'Name',
			'zip' => 'Zip',
			'country' => 'Country',
			'street2' => 'Street2',
			'bic' => 'Bic',
			'phone' => 'Phone',
			'state' => 'State',
			'street' => 'Street',
			'active' => 'Active',
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
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('zip',$this->zip,true);
		$criteria->compare('country',$this->country);
		$criteria->compare('street2',$this->street2,true);
		$criteria->compare('bic',$this->bic,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('email',$this->email,true);

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
	 * @return ResBank the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
