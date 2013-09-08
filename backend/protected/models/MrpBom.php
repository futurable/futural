<?php

/**
 * This is the model class for table "mrp_bom".
 *
 * The followings are the available columns in table 'mrp_bom':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $date_stop
 * @property string $code
 * @property integer $product_uom
 * @property double $product_uos_qty
 * @property string $date_start
 * @property string $product_qty
 * @property integer $product_uos
 * @property double $product_efficiency
 * @property boolean $active
 * @property double $product_rounding
 * @property string $name
 * @property integer $sequence
 * @property integer $company_id
 * @property integer $routing_id
 * @property integer $product_id
 * @property integer $bom_id
 * @property string $position
 * @property string $type
 *
 * The followings are the available model relations:
 * @property MrpBomPropertyRel[] $mrpBomPropertyRels
 * @property ResUsers $writeU
 * @property MrpRouting $routing
 * @property ProductUom $productUos
 * @property ProductUom $productUom
 * @property ProductProduct $product
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property MrpBom $bom
 * @property MrpBom[] $mrpBoms
 * @property MrpProduction[] $mrpProductions
 * @property ProcurementOrder[] $procurementOrders
 */
class MrpBom extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mrp_bom';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_uom, product_qty, product_efficiency, company_id, product_id, type', 'required'),
			array('create_uid, write_uid, product_uom, product_uos, sequence, company_id, routing_id, product_id, bom_id', 'numerical', 'integerOnly'=>true),
			array('product_uos_qty, product_efficiency, product_rounding', 'numerical'),
			array('code', 'length', 'max'=>16),
			array('name, position', 'length', 'max'=>64),
			array('create_date, write_date, date_stop, date_start, active', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, date_stop, code, product_uom, product_uos_qty, date_start, product_qty, product_uos, product_efficiency, active, product_rounding, name, sequence, company_id, routing_id, product_id, bom_id, position, type', 'safe', 'on'=>'search'),
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
			'mrpBomPropertyRels' => array(self::HAS_MANY, 'MrpBomPropertyRel', 'bom_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'routing' => array(self::BELONGS_TO, 'MrpRouting', 'routing_id'),
			'productUos' => array(self::BELONGS_TO, 'ProductUom', 'product_uos'),
			'productUom' => array(self::BELONGS_TO, 'ProductUom', 'product_uom'),
			'product' => array(self::BELONGS_TO, 'ProductProduct', 'product_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'bom' => array(self::BELONGS_TO, 'MrpBom', 'bom_id'),
			'mrpBoms' => array(self::HAS_MANY, 'MrpBom', 'bom_id'),
			'mrpProductions' => array(self::HAS_MANY, 'MrpProduction', 'bom_id'),
			'procurementOrders' => array(self::HAS_MANY, 'ProcurementOrder', 'bom_id'),
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
			'date_stop' => 'Date Stop',
			'code' => 'Code',
			'product_uom' => 'Product Uom',
			'product_uos_qty' => 'Product Uos Qty',
			'date_start' => 'Date Start',
			'product_qty' => 'Product Qty',
			'product_uos' => 'Product Uos',
			'product_efficiency' => 'Product Efficiency',
			'active' => 'Active',
			'product_rounding' => 'Product Rounding',
			'name' => 'Name',
			'sequence' => 'Sequence',
			'company_id' => 'Company',
			'routing_id' => 'Routing',
			'product_id' => 'Product',
			'bom_id' => 'Bom',
			'position' => 'Position',
			'type' => 'Type',
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
		$criteria->compare('date_stop',$this->date_stop,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('product_uom',$this->product_uom);
		$criteria->compare('product_uos_qty',$this->product_uos_qty);
		$criteria->compare('date_start',$this->date_start,true);
		$criteria->compare('product_qty',$this->product_qty,true);
		$criteria->compare('product_uos',$this->product_uos);
		$criteria->compare('product_efficiency',$this->product_efficiency);
		$criteria->compare('active',$this->active);
		$criteria->compare('product_rounding',$this->product_rounding);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('routing_id',$this->routing_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('bom_id',$this->bom_id);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('type',$this->type,true);

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
	 * @return MrpBom the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
