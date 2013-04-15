<?php

/**
 * This is the model class for table "token_key".
 *
 * The followings are the available columns in table 'token_key':
 * @property integer $id
 * @property string $token_key
 * @property integer $lifetime
 * @property string $create_date
 * @property string $reclaim_date
 * @property string $expiration_date
 * @property integer $token_customer_id
 * @property integer $token_setup_id
 *
 * The followings are the available model relations:
 * @property Company[] $companies
 * @property TokenCustomer $tokenCustomer
 * @property TokenSetup $tokenSetup
 */
class TokenKey extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'token_key';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('token_key', 'ext.validators.validTokenKey', 'on' => 'validTokenKey'),
			array('token_key, lifetime, token_customer_id, token_setup_id', 'required', 'on' => '-validTokenKey'),
			array('lifetime, token_customer_id, token_setup_id', 'numerical', 'integerOnly'=>true),
			array('token_key', 'length', 'max'=>16),
			array('token_key', 'length', 'min'=>6),
			array('create_date, reclaim_date, expiration_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('token_key, lifetime, create_date, reclaim_date, expiration_date, token_customer_id, token_setup_id', 'safe', 'on'=>'search'),
                        array('token_key', 'safe'),
                        array('reclaim_date','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
                        array('expiration_date','default', 'value'=>new CDbExpression('DATE_ADD(reclaim_date, INTERVAL lifetime MONTH)'), 'setOnEmpty'=>false,'on'=>'update'),
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
			'companies' => array(self::HAS_MANY, 'Company', 'token_key_id'),
			'tokenCustomer' => array(self::BELONGS_TO, 'TokenCustomer', 'token_customer_id'),
			'tokenSetup' => array(self::BELONGS_TO, 'TokenSetup', 'token_setup_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'token_key' => 'Token Key',
			'lifetime' => 'Lifetime',
			'create_date' => 'Create Date',
			'reclaim_date' => 'Reclaim Date',
			'expiration_date' => 'Expiration Date',
			'token_customer_id' => 'Token Customer',
			'token_setup_id' => 'Token Setup',
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
		$criteria->compare('token_key',$this->token_key,true);
		$criteria->compare('lifetime',$this->lifetime);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('reclaim_date',$this->reclaim_date,true);
		$criteria->compare('expiration_date',$this->expiration_date,true);
		$criteria->compare('token_customer_id',$this->token_customer_id);
		$criteria->compare('token_setup_id',$this->token_setup_id);

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
