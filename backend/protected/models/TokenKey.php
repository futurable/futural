<?php

/**
 * This is the model class for table "Token_Key".
 *
 * The followings are the available columns in table 'Token_Key':
 * @property integer $ID
 * @property string $TokenKey
 * @property string $CreateDate
 * @property string $ReclaimDate
 * @property integer $Lifetime
 * @property string $ExpirationDate
 * @property integer $Token_Customer_ID
 * @property integer $Token_Settings_ID
 *
 * The followings are the available model relations:
 * @property TokenCustomer $tokenCustomer
 * @property TokenSettings $tokenSettings
 */
class TokenKey extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Token_Key';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TokenKey, Lifetime, Token_Customer_ID, Token_Settings_ID', 'required'),
			array('Lifetime, Token_Customer_ID, Token_Settings_ID', 'numerical', 'integerOnly'=>true),
			array('TokenKey', 'length', 'max'=>16),
			array('CreateDate, ReclaimDate, ExpirationDate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, TokenKey, CreateDate, ReclaimDate, Lifetime, ExpirationDate, Token_Customer_ID, Token_Settings_ID', 'safe', 'on'=>'search'),
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
			'tokenCustomer' => array(self::BELONGS_TO, 'TokenCustomer', 'Token_Customer_ID'),
			'tokenSettings' => array(self::BELONGS_TO, 'TokenSettings', 'Token_Settings_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'TokenKey' => 'Token Key',
			'CreateDate' => 'Create Date',
			'ReclaimDate' => 'Reclaim Date',
			'Lifetime' => 'Lifetime',
			'ExpirationDate' => 'Expiration Date',
			'Token_Customer_ID' => 'Token Customer',
			'Token_Settings_ID' => 'Token Settings',
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
		$criteria->compare('TokenKey',$this->TokenKey,true);
		$criteria->compare('CreateDate',$this->CreateDate,true);
		$criteria->compare('ReclaimDate',$this->ReclaimDate,true);
		$criteria->compare('Lifetime',$this->Lifetime);
		$criteria->compare('ExpirationDate',$this->ExpirationDate,true);
		$criteria->compare('Token_Customer_ID',$this->Token_Customer_ID);
		$criteria->compare('Token_Settings_ID',$this->Token_Settings_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TokenKey the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
