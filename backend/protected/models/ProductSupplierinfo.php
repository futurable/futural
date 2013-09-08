<?php

/**
 * This is the model class for table "product_supplierinfo".
 *
 * The followings are the available columns in table 'product_supplierinfo':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $name
 * @property integer $sequence
 * @property integer $company_id
 * @property string $qty
 * @property integer $delay
 * @property double $min_qty
 * @property string $product_code
 * @property string $product_name
 * @property integer $product_id
 *
 * The followings are the available model relations:
 * @property PricelistPartnerinfo[] $pricelistPartnerinfos
 * @property ResUsers $writeU
 * @property ProductTemplate $product
 * @property ResPartner $name0
 * @property ResUsers $createU
 * @property ResCompany $company
 */
class ProductSupplierinfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_supplierinfo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, delay, min_qty, product_id', 'required'),
			array('create_uid, write_uid, name, sequence, company_id, delay, product_id', 'numerical', 'integerOnly'=>true),
			array('min_qty', 'numerical'),
			array('product_code', 'length', 'max'=>64),
			array('product_name', 'length', 'max'=>128),
			array('create_date, write_date, qty', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, name, sequence, company_id, qty, delay, min_qty, product_code, product_name, product_id', 'safe', 'on'=>'search'),
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
			'pricelistPartnerinfos' => array(self::HAS_MANY, 'PricelistPartnerinfo', 'suppinfo_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'product' => array(self::BELONGS_TO, 'ProductTemplate', 'product_id'),
			'name0' => array(self::BELONGS_TO, 'ResPartner', 'name'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
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
			'name' => 'Name',
			'sequence' => 'Sequence',
			'company_id' => 'Company',
			'qty' => 'Qty',
			'delay' => 'Delay',
			'min_qty' => 'Min Qty',
			'product_code' => 'Product Code',
			'product_name' => 'Product Name',
			'product_id' => 'Product',
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
		$criteria->compare('name',$this->name);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('qty',$this->qty,true);
		$criteria->compare('delay',$this->delay);
		$criteria->compare('min_qty',$this->min_qty);
		$criteria->compare('product_code',$this->product_code,true);
		$criteria->compare('product_name',$this->product_name,true);
		$criteria->compare('product_id',$this->product_id);

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
	 * @return ProductSupplierinfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
