<?php

/**
 * This is the model class for table "res_partner_bank".
 *
 * The followings are the available columns in table 'res_partner_bank':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $bank_name
 * @property string $owner_name
 * @property integer $sequence
 * @property string $street
 * @property integer $partner_id
 * @property integer $bank
 * @property string $bank_bic
 * @property string $city
 * @property string $name
 * @property string $zip
 * @property boolean $footer
 * @property integer $country_id
 * @property integer $company_id
 * @property string $state
 * @property integer $state_id
 * @property string $acc_number
 * @property integer $journal_id
 *
 * The followings are the available model relations:
 * @property AccountInvoice[] $accountInvoices
 * @property HrEmployee[] $hrEmployees
 * @property ResUsers $writeU
 * @property ResCountryState $state0
 * @property ResPartner $partner
 * @property AccountJournal $journal
 * @property ResUsers $createU
 * @property ResCountry $country
 * @property ResCompany $company
 * @property ResBank $bank0
 */
class ResPartnerBank extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'res_partner_bank';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('partner_id, state, acc_number', 'required'),
			array('create_uid, write_uid, sequence, partner_id, bank, country_id, company_id, state_id, journal_id', 'numerical', 'integerOnly'=>true),
			array('bank_name', 'length', 'max'=>32),
			array('owner_name, street, city', 'length', 'max'=>128),
			array('bank_bic', 'length', 'max'=>16),
			array('name, acc_number', 'length', 'max'=>64),
			array('zip', 'length', 'max'=>24),
			array('create_date, write_date, footer', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, bank_name, owner_name, sequence, street, partner_id, bank, bank_bic, city, name, zip, footer, country_id, company_id, state, state_id, acc_number, journal_id', 'safe', 'on'=>'search'),
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
			'accountInvoices' => array(self::HAS_MANY, 'AccountInvoice', 'partner_bank_id'),
			'hrEmployees' => array(self::HAS_MANY, 'HrEmployee', 'bank_account_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'state0' => array(self::BELONGS_TO, 'ResCountryState', 'state_id'),
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'journal' => array(self::BELONGS_TO, 'AccountJournal', 'journal_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'country' => array(self::BELONGS_TO, 'ResCountry', 'country_id'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'bank0' => array(self::BELONGS_TO, 'ResBank', 'bank'),
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
			'bank_name' => 'Bank Name',
			'owner_name' => 'Owner Name',
			'sequence' => 'Sequence',
			'street' => 'Street',
			'partner_id' => 'Partner',
			'bank' => 'Bank',
			'bank_bic' => 'Bank Bic',
			'city' => 'City',
			'name' => 'Name',
			'zip' => 'Zip',
			'footer' => 'Footer',
			'country_id' => 'Country',
			'company_id' => 'Company',
			'state' => 'State',
			'state_id' => 'State',
			'acc_number' => 'Acc Number',
			'journal_id' => 'Journal',
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
		$criteria->compare('bank_name',$this->bank_name,true);
		$criteria->compare('owner_name',$this->owner_name,true);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('bank',$this->bank);
		$criteria->compare('bank_bic',$this->bank_bic,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('zip',$this->zip,true);
		$criteria->compare('footer',$this->footer);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('acc_number',$this->acc_number,true);
		$criteria->compare('journal_id',$this->journal_id);

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
	 * @return ResPartnerBank the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
