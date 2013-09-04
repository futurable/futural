<?php

/**
 * This is the model class for table "mrp_production".
 *
 * The followings are the available columns in table 'mrp_production':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $origin
 * @property integer $product_uom
 * @property double $product_uos_qty
 * @property string $product_qty
 * @property integer $product_uos
 * @property integer $user_id
 * @property integer $location_src_id
 * @property string $cycle_total
 * @property string $date_start
 * @property integer $company_id
 * @property string $priority
 * @property string $state
 * @property integer $bom_id
 * @property string $date_finished
 * @property string $name
 * @property integer $product_id
 * @property string $date_planned
 * @property integer $move_prod_id
 * @property integer $routing_id
 * @property string $hour_total
 * @property integer $location_dest_id
 * @property integer $picking_id
 *
 * The followings are the available model relations:
 * @property MrpProductionWorkcenterLine[] $mrpProductionWorkcenterLines
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property MrpRouting $routing
 * @property ProductUom $productUos
 * @property ProductUom $productUom
 * @property ProductProduct $product
 * @property StockPicking $picking
 * @property StockMove $moveProd
 * @property StockLocation $locationSrc
 * @property StockLocation $locationDest
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property MrpBom $bom
 * @property ProcurementOrder[] $procurementOrders
 * @property StockMove[] $stockMoves
 * @property MrpProductionProductLine[] $mrpProductionProductLines
 * @property MrpProductionMoveIds[] $mrpProductionMoveIds
 */
class MrpProduction extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mrp_production';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_uom, product_qty, location_src_id, company_id, name, product_id, date_planned, location_dest_id', 'required'),
			array('create_uid, write_uid, product_uom, product_uos, user_id, location_src_id, company_id, bom_id, product_id, move_prod_id, routing_id, location_dest_id, picking_id', 'numerical', 'integerOnly'=>true),
			array('product_uos_qty', 'numerical'),
			array('origin, name', 'length', 'max'=>64),
			array('create_date, write_date, cycle_total, date_start, priority, state, date_finished, hour_total', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, origin, product_uom, product_uos_qty, product_qty, product_uos, user_id, location_src_id, cycle_total, date_start, company_id, priority, state, bom_id, date_finished, name, product_id, date_planned, move_prod_id, routing_id, hour_total, location_dest_id, picking_id', 'safe', 'on'=>'search'),
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
			'mrpProductionWorkcenterLines' => array(self::HAS_MANY, 'MrpProductionWorkcenterLine', 'production_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'user' => array(self::BELONGS_TO, 'ResUsers', 'user_id'),
			'routing' => array(self::BELONGS_TO, 'MrpRouting', 'routing_id'),
			'productUos' => array(self::BELONGS_TO, 'ProductUom', 'product_uos'),
			'productUom' => array(self::BELONGS_TO, 'ProductUom', 'product_uom'),
			'product' => array(self::BELONGS_TO, 'ProductProduct', 'product_id'),
			'picking' => array(self::BELONGS_TO, 'StockPicking', 'picking_id'),
			'moveProd' => array(self::BELONGS_TO, 'StockMove', 'move_prod_id'),
			'locationSrc' => array(self::BELONGS_TO, 'StockLocation', 'location_src_id'),
			'locationDest' => array(self::BELONGS_TO, 'StockLocation', 'location_dest_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'bom' => array(self::BELONGS_TO, 'MrpBom', 'bom_id'),
			'procurementOrders' => array(self::HAS_MANY, 'ProcurementOrder', 'production_id'),
			'stockMoves' => array(self::HAS_MANY, 'StockMove', 'production_id'),
			'mrpProductionProductLines' => array(self::HAS_MANY, 'MrpProductionProductLine', 'production_id'),
			'mrpProductionMoveIds' => array(self::HAS_MANY, 'MrpProductionMoveIds', 'production_id'),
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
			'origin' => 'Origin',
			'product_uom' => 'Product Uom',
			'product_uos_qty' => 'Product Uos Qty',
			'product_qty' => 'Product Qty',
			'product_uos' => 'Product Uos',
			'user_id' => 'User',
			'location_src_id' => 'Location Src',
			'cycle_total' => 'Cycle Total',
			'date_start' => 'Date Start',
			'company_id' => 'Company',
			'priority' => 'Priority',
			'state' => 'State',
			'bom_id' => 'Bom',
			'date_finished' => 'Date Finished',
			'name' => 'Name',
			'product_id' => 'Product',
			'date_planned' => 'Date Planned',
			'move_prod_id' => 'Move Prod',
			'routing_id' => 'Routing',
			'hour_total' => 'Hour Total',
			'location_dest_id' => 'Location Dest',
			'picking_id' => 'Picking',
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
		$criteria->compare('origin',$this->origin,true);
		$criteria->compare('product_uom',$this->product_uom);
		$criteria->compare('product_uos_qty',$this->product_uos_qty);
		$criteria->compare('product_qty',$this->product_qty,true);
		$criteria->compare('product_uos',$this->product_uos);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('location_src_id',$this->location_src_id);
		$criteria->compare('cycle_total',$this->cycle_total,true);
		$criteria->compare('date_start',$this->date_start,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('priority',$this->priority,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('bom_id',$this->bom_id);
		$criteria->compare('date_finished',$this->date_finished,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('date_planned',$this->date_planned,true);
		$criteria->compare('move_prod_id',$this->move_prod_id);
		$criteria->compare('routing_id',$this->routing_id);
		$criteria->compare('hour_total',$this->hour_total,true);
		$criteria->compare('location_dest_id',$this->location_dest_id);
		$criteria->compare('picking_id',$this->picking_id);

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
	 * @return MrpProduction the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
