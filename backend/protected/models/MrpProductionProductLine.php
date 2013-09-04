<?php

/**
 * This is the model class for table "mrp_production_product_line".
 *
 * The followings are the available columns in table 'mrp_production_product_line':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property double $product_uos_qty
 * @property string $name
 * @property integer $product_uom
 * @property string $product_qty
 * @property integer $product_uos
 * @property integer $production_id
 * @property integer $product_id
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property MrpProduction $production
 * @property ProductUom $productUos
 * @property ProductUom $productUom
 * @property ProductProduct $product
 * @property ResUsers $createU
 */
class MrpProductionProductLine extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mrp_production_product_line';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, product_uom, product_qty, product_id', 'required'),
			array('create_uid, write_uid, product_uom, product_uos, production_id, product_id', 'numerical', 'integerOnly'=>true),
			array('product_uos_qty', 'numerical'),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, product_uos_qty, name, product_uom, product_qty, product_uos, production_id, product_id', 'safe', 'on'=>'search'),
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
			'production' => array(self::BELONGS_TO, 'MrpProduction', 'production_id'),
			'productUos' => array(self::BELONGS_TO, 'ProductUom', 'product_uos'),
			'productUom' => array(self::BELONGS_TO, 'ProductUom', 'product_uom'),
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
			'product_uos_qty' => 'Product Uos Qty',
			'name' => 'Name',
			'product_uom' => 'Product Uom',
			'product_qty' => 'Product Qty',
			'product_uos' => 'Product Uos',
			'production_id' => 'Production',
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
		$criteria->compare('product_uos_qty',$this->product_uos_qty);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('product_uom',$this->product_uom);
		$criteria->compare('product_qty',$this->product_qty,true);
		$criteria->compare('product_uos',$this->product_uos);
		$criteria->compare('production_id',$this->production_id);
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
	 * @return MrpProductionProductLine the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
