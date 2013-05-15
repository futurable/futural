<?php

/**
 * This is the model class for table "order_setup".
 *
 * The followings are the available columns in table 'order_setup':
 * @property integer $id
 * @property string $type
 * @property integer $amount
 * @property integer $rows
 * @property integer $token_customer_id
 * @property string $create_date
 * @property string $alter_date
 *
 * The followings are the available model relations:
 * @property Order[] $orders
 * @property OrderFactor[] $orderFactors
 * @property TokenCustomer $tokenCustomer
 */
class OrderSetup extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_setup';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, token_customer_id', 'required'),
			array('id, amount, rows, token_customer_id', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>7),
			array('create_date, alter_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, amount, rows, token_customer_id, create_date, alter_date', 'safe', 'on'=>'search'),
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
			'orders' => array(self::HAS_MANY, 'Order', 'order_setup_id'),
			'orderFactors' => array(self::HAS_MANY, 'OrderFactor', 'order_setup_id'),
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
			'type' => 'Type',
			'amount' => 'Amount',
			'rows' => 'Rows',
			'token_customer_id' => 'Token Customer',
			'create_date' => 'Create Date',
			'alter_date' => 'Alter Date',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('rows',$this->rows);
		$criteria->compare('token_customer_id',$this->token_customer_id);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('alter_date',$this->alter_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderSetup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
