<?php

/**
 * This is the model class for table "sale_advance_payment_inv".
 *
 * The followings are the available columns in table 'sale_advance_payment_inv':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $advance_payment_method
 * @property string $amount
 * @property integer $product_id
 * @property string $qtty
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ProductProduct $product
 * @property ResUsers $createU
 */
class SaleAdvancePaymentInv extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sale_advance_payment_inv';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('advance_payment_method, qtty', 'required'),
			array('create_uid, write_uid, product_id', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date, amount', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, advance_payment_method, amount, product_id, qtty', 'safe', 'on'=>'search'),
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
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'product' => array(self::BELONGS_TO, 'ProductProduct', 'product_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
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
			'advance_payment_method' => 'Advance Payment Method',
			'amount' => 'Amount',
			'product_id' => 'Product',
			'qtty' => 'Qtty',
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
		$criteria->compare('advance_payment_method',$this->advance_payment_method,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('qtty',$this->qtty,true);

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
	 * @return SaleAdvancePaymentInv the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
