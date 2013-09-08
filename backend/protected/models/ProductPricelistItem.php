<?php

/**
 * This is the model class for table "product_pricelist_item".
 *
 * The followings are the available columns in table 'product_pricelist_item':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $price_round
 * @property string $price_discount
 * @property integer $base_pricelist_id
 * @property integer $sequence
 * @property string $price_max_margin
 * @property integer $company_id
 * @property string $name
 * @property integer $product_tmpl_id
 * @property integer $product_id
 * @property integer $base
 * @property integer $price_version_id
 * @property integer $min_quantity
 * @property string $price_min_margin
 * @property integer $categ_id
 * @property string $price_surcharge
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ProductTemplate $productTmpl
 * @property ProductProduct $product
 * @property ProductPricelistVersion $priceVersion
 * @property ResUsers $createU
 * @property ProductCategory $categ
 * @property ProductPricelist $basePricelist
 */
class ProductPricelistItem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_pricelist_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sequence, base, price_version_id, min_quantity', 'required'),
			array('create_uid, write_uid, base_pricelist_id, sequence, company_id, product_tmpl_id, product_id, base, price_version_id, min_quantity, categ_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, price_round, price_discount, price_max_margin, price_min_margin, price_surcharge', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, price_round, price_discount, base_pricelist_id, sequence, price_max_margin, company_id, name, product_tmpl_id, product_id, base, price_version_id, min_quantity, price_min_margin, categ_id, price_surcharge', 'safe', 'on'=>'search'),
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
			'productTmpl' => array(self::BELONGS_TO, 'ProductTemplate', 'product_tmpl_id'),
			'product' => array(self::BELONGS_TO, 'ProductProduct', 'product_id'),
			'priceVersion' => array(self::BELONGS_TO, 'ProductPricelistVersion', 'price_version_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'categ' => array(self::BELONGS_TO, 'ProductCategory', 'categ_id'),
			'basePricelist' => array(self::BELONGS_TO, 'ProductPricelist', 'base_pricelist_id'),
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
			'price_round' => 'Price Round',
			'price_discount' => 'Price Discount',
			'base_pricelist_id' => 'Base Pricelist',
			'sequence' => 'Sequence',
			'price_max_margin' => 'Price Max Margin',
			'company_id' => 'Company',
			'name' => 'Name',
			'product_tmpl_id' => 'Product Tmpl',
			'product_id' => 'Product',
			'base' => 'Base',
			'price_version_id' => 'Price Version',
			'min_quantity' => 'Min Quantity',
			'price_min_margin' => 'Price Min Margin',
			'categ_id' => 'Categ',
			'price_surcharge' => 'Price Surcharge',
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
		$criteria->compare('price_round',$this->price_round,true);
		$criteria->compare('price_discount',$this->price_discount,true);
		$criteria->compare('base_pricelist_id',$this->base_pricelist_id);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('price_max_margin',$this->price_max_margin,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('product_tmpl_id',$this->product_tmpl_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('base',$this->base);
		$criteria->compare('price_version_id',$this->price_version_id);
		$criteria->compare('min_quantity',$this->min_quantity);
		$criteria->compare('price_min_margin',$this->price_min_margin,true);
		$criteria->compare('categ_id',$this->categ_id);
		$criteria->compare('price_surcharge',$this->price_surcharge,true);

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
	 * @return ProductPricelistItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
