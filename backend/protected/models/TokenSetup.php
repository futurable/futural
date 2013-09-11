<?php

/**
 * This is the model class for table "token_setup".
 *
 * The followings are the available columns in table 'token_setup':
 * @property integer $id
 * @property string $description
 * @property integer $create_init_data
 * @property integer $create_demo_data
 * @property integer $create_purchasing_orders
 * @property integer $token_customer_id
 *
 * The followings are the available model relations:
 * @property TokenKey[] $tokenKeys
 * @property TokenCustomer $tokenCustomer
 */
class TokenSetup extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'token_setup';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description, token_customer_id', 'required'),
			array('create_init_data, create_demo_data, create_purchasing_orders, token_customer_id', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, description, create_init_data, create_demo_data, create_purchasing_orders, token_customer_id', 'safe', 'on'=>'search'),
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
			'tokenKeys' => array(self::HAS_MANY, 'TokenKey', 'token_setup_id'),
			'tokenCustomer' => array(self::BELONGS_TO, 'TokenCustomer', 'token_customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'description' => 'Description',
			'create_init_data' => 'Create Init Data',
			'create_demo_data' => 'Create Demo Data',
			'create_purchasing_orders' => 'Create Purchasing Orders',
			'token_customer_id' => 'Token Customer',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('create_init_data',$this->create_init_data);
		$criteria->compare('create_demo_data',$this->create_demo_data);
		$criteria->compare('create_purchasing_orders',$this->create_purchasing_orders);
		$criteria->compare('token_customer_id',$this->token_customer_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TokenSetup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
