<?php

/**
 * This is the model class for table "product_packaging".
 *
 * The followings are the available columns in table 'product_packaging':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $ul
 * @property string $code
 * @property integer $product_id
 * @property double $weight
 * @property integer $sequence
 * @property integer $ul_qty
 * @property string $ean
 * @property double $qty
 * @property double $width
 * @property double $length
 * @property integer $rows
 * @property double $height
 * @property double $weight_ul
 * @property string $name
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ProductUl $ul0
 * @property ProductProduct $product
 * @property ResUsers $createU
 * @property StockMove[] $stockMoves
 * @property SaleOrderLine[] $saleOrderLines
 */
class ProductPackaging extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_packaging';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ul, product_id, rows', 'required'),
			array('create_uid, write_uid, ul, product_id, sequence, ul_qty, rows', 'numerical', 'integerOnly'=>true),
			array('weight, qty, width, length, height, weight_ul', 'numerical'),
			array('code, ean', 'length', 'max'=>14),
			array('create_date, write_date, name', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, ul, code, product_id, weight, sequence, ul_qty, ean, qty, width, length, rows, height, weight_ul, name', 'safe', 'on'=>'search'),
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
			'ul0' => array(self::BELONGS_TO, 'ProductUl', 'ul'),
			'product' => array(self::BELONGS_TO, 'ProductProduct', 'product_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'stockMoves' => array(self::HAS_MANY, 'StockMove', 'product_packaging'),
			'saleOrderLines' => array(self::HAS_MANY, 'SaleOrderLine', 'product_packaging'),
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
			'ul' => 'Ul',
			'code' => 'Code',
			'product_id' => 'Product',
			'weight' => 'Weight',
			'sequence' => 'Sequence',
			'ul_qty' => 'Ul Qty',
			'ean' => 'Ean',
			'qty' => 'Qty',
			'width' => 'Width',
			'length' => 'Length',
			'rows' => 'Rows',
			'height' => 'Height',
			'weight_ul' => 'Weight Ul',
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
		$criteria->compare('ul',$this->ul);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('ul_qty',$this->ul_qty);
		$criteria->compare('ean',$this->ean,true);
		$criteria->compare('qty',$this->qty);
		$criteria->compare('width',$this->width);
		$criteria->compare('length',$this->length);
		$criteria->compare('rows',$this->rows);
		$criteria->compare('height',$this->height);
		$criteria->compare('weight_ul',$this->weight_ul);
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
	 * @return ProductPackaging the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
