<?php

/**
 * This is the model class for table "product_price_list".
 *
 * The followings are the available columns in table 'product_price_list':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $qty1
 * @property integer $qty2
 * @property integer $qty3
 * @property integer $qty4
 * @property integer $qty5
 * @property integer $price_list
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ProductPricelist $priceList
 * @property ResUsers $createU
 */
class ProductPriceList extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_price_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('price_list', 'required'),
			array('create_uid, write_uid, qty1, qty2, qty3, qty4, qty5, price_list', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, qty1, qty2, qty3, qty4, qty5, price_list', 'safe', 'on'=>'search'),
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
			'priceList' => array(self::BELONGS_TO, 'ProductPricelist', 'price_list'),
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
			'qty1' => 'Qty1',
			'qty2' => 'Qty2',
			'qty3' => 'Qty3',
			'qty4' => 'Qty4',
			'qty5' => 'Qty5',
			'price_list' => 'Price List',
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
		$criteria->compare('qty1',$this->qty1);
		$criteria->compare('qty2',$this->qty2);
		$criteria->compare('qty3',$this->qty3);
		$criteria->compare('qty4',$this->qty4);
		$criteria->compare('qty5',$this->qty5);
		$criteria->compare('price_list',$this->price_list);

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
	 * @return ProductPriceList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
