<?php

/**
 * This is the model class for table "stock_move_split".
 *
 * The followings are the available columns in table 'stock_move_split':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $product_id
 * @property integer $product_uom
 * @property integer $location_id
 * @property boolean $use_exist
 * @property string $qty
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ProductUom $productUom
 * @property ProductProduct $product
 * @property StockLocation $location
 * @property ResUsers $createU
 * @property StockMoveSplitLines[] $stockMoveSplitLines
 * @property StockMoveSplitLines[] $stockMoveSplitLines1
 */
class StockMoveSplit extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stock_move_split';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id', 'required'),
			array('create_uid, write_uid, product_id, product_uom, location_id', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date, use_exist, qty', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, product_id, product_uom, location_id, use_exist, qty', 'safe', 'on'=>'search'),
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
			'productUom' => array(self::BELONGS_TO, 'ProductUom', 'product_uom'),
			'product' => array(self::BELONGS_TO, 'ProductProduct', 'product_id'),
			'location' => array(self::BELONGS_TO, 'StockLocation', 'location_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'stockMoveSplitLines' => array(self::HAS_MANY, 'StockMoveSplitLines', 'wizard_id'),
			'stockMoveSplitLines1' => array(self::HAS_MANY, 'StockMoveSplitLines', 'wizard_exist_id'),
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
			'product_id' => 'Product',
			'product_uom' => 'Product Uom',
			'location_id' => 'Location',
			'use_exist' => 'Use Exist',
			'qty' => 'Qty',
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
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('product_uom',$this->product_uom);
		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('use_exist',$this->use_exist);
		$criteria->compare('qty',$this->qty,true);

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
	 * @return StockMoveSplit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
