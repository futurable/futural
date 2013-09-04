<?php

/**
 * This is the model class for table "res_country".
 *
 * The followings are the available columns in table 'res_country':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $address_format
 * @property integer $currency_id
 * @property string $code
 * @property string $name
 *
 * The followings are the available model relations:
 * @property CrmLead[] $crmLeads
 * @property HrEmployee[] $hrEmployees
 * @property ResUsers $writeU
 * @property ResCurrency $currency
 * @property ResUsers $createU
 * @property ResPartnerBank[] $resPartnerBanks
 * @property ResPartner[] $resPartners
 * @property ResBank[] $resBanks
 * @property ResCountryState[] $resCountryStates
 */
class ResCountry extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'res_country';
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
			array('create_uid, write_uid, currency_id', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>2),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, address_format', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, address_format, currency_id, code, name', 'safe', 'on'=>'search'),
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
			'crmLeads' => array(self::HAS_MANY, 'CrmLead', 'country_id'),
			'hrEmployees' => array(self::HAS_MANY, 'HrEmployee', 'country_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'currency' => array(self::BELONGS_TO, 'ResCurrency', 'currency_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'resPartnerBanks' => array(self::HAS_MANY, 'ResPartnerBank', 'country_id'),
			'resPartners' => array(self::HAS_MANY, 'ResPartner', 'country_id'),
			'resBanks' => array(self::HAS_MANY, 'ResBank', 'country'),
			'resCountryStates' => array(self::HAS_MANY, 'ResCountryState', 'country_id'),
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
			'address_format' => 'Address Format',
			'currency_id' => 'Currency',
			'code' => 'Code',
			'name' => 'Name',
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
		$criteria->compare('address_format',$this->address_format,true);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);

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
	 * @return ResCountry the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
