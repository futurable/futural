<?php

/**
 * This is the model class for table "stock_production_lot".
 *
 * The followings are the available columns in table 'stock_production_lot':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $name
 * @property integer $company_id
 * @property string $prefix
 * @property integer $product_id
 * @property string $date
 * @property string $ref
 *
 * The followings are the available model relations:
 * @property StockMove[] $stockMoves
 * @property StockInventoryLine[] $stockInventoryLines
 * @property StockChangeProductQty[] $stockChangeProductQties
 * @property StockPartialPickingLine[] $stockPartialPickingLines
 * @property StockProductionLotRevision[] $stockProductionLotRevisions
 * @property StockInventoryLineSplitLines[] $stockInventoryLineSplitLines
 * @property StockPartialMoveLine[] $stockPartialMoveLines
 * @property ResUsers $writeU
 * @property ProductProduct $product
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property StockMoveSplitLines[] $stockMoveSplitLines
 */
class StockProductionLot extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stock_production_lot';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, product_id, date', 'required'),
			array('create_uid, write_uid, company_id, product_id', 'numerical', 'integerOnly'=>true),
			array('name, prefix', 'length', 'max'=>64),
			array('ref', 'length', 'max'=>256),
			array('create_date, write_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, name, company_id, prefix, product_id, date, ref', 'safe', 'on'=>'search'),
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
			'stockMoves' => array(self::HAS_MANY, 'StockMove', 'prodlot_id'),
			'stockInventoryLines' => array(self::HAS_MANY, 'StockInventoryLine', 'prod_lot_id'),
			'stockChangeProductQties' => array(self::HAS_MANY, 'StockChangeProductQty', 'prodlot_id'),
			'stockPartialPickingLines' => array(self::HAS_MANY, 'StockPartialPickingLine', 'prodlot_id'),
			'stockProductionLotRevisions' => array(self::HAS_MANY, 'StockProductionLotRevision', 'lot_id'),
			'stockInventoryLineSplitLines' => array(self::HAS_MANY, 'StockInventoryLineSplitLines', 'prodlot_id'),
			'stockPartialMoveLines' => array(self::HAS_MANY, 'StockPartialMoveLine', 'prodlot_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'product' => array(self::BELONGS_TO, 'ProductProduct', 'product_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'stockMoveSplitLines' => array(self::HAS_MANY, 'StockMoveSplitLines', 'prodlot_id'),
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
			'company_id' => 'Company',
			'prefix' => 'Prefix',
			'product_id' => 'Product',
			'date' => 'Date',
			'ref' => 'Ref',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('prefix',$this->prefix,true);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('ref',$this->ref,true);

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
	 * @return StockProductionLot the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
