<?php

/**
 * This is the model class for table "make_procurement".
 *
 * The followings are the available columns in table 'make_procurement':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $uom_id
 * @property string $date_planned
 * @property string $qty
 * @property integer $product_id
 * @property integer $warehouse_id
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property StockWarehouse $warehouse
 * @property ProductUom $uom
 * @property ProductProduct $product
 * @property ResUsers $createU
 */
class MakeProcurement extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'make_procurement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uom_id, date_planned, qty, product_id, warehouse_id', 'required'),
			array('create_uid, write_uid, uom_id, product_id, warehouse_id', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, uom_id, date_planned, qty, product_id, warehouse_id', 'safe', 'on'=>'search'),
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
			'warehouse' => array(self::BELONGS_TO, 'StockWarehouse', 'warehouse_id'),
			'uom' => array(self::BELONGS_TO, 'ProductUom', 'uom_id'),
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
			'uom_id' => 'Uom',
			'date_planned' => 'Date Planned',
			'qty' => 'Qty',
			'product_id' => 'Product',
			'warehouse_id' => 'Warehouse',
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
		$criteria->compare('uom_id',$this->uom_id);
		$criteria->compare('date_planned',$this->date_planned,true);
		$criteria->compare('qty',$this->qty,true);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('warehouse_id',$this->warehouse_id);

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
	 * @return MakeProcurement the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
