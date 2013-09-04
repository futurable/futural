<?php

/**
 * This is the model class for table "stock_picking".
 *
 * The followings are the available columns in table 'stock_picking':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $origin
 * @property string $date_done
 * @property string $min_date
 * @property string $date
 * @property integer $partner_id
 * @property integer $stock_journal_id
 * @property integer $backorder_id
 * @property string $name
 * @property integer $location_id
 * @property string $move_type
 * @property integer $company_id
 * @property string $invoice_state
 * @property string $note
 * @property string $state
 * @property integer $location_dest_id
 * @property string $max_date
 * @property boolean $auto_picking
 * @property string $type
 * @property integer $purchase_id
 * @property integer $sale_id
 *
 * The followings are the available model relations:
 * @property MrpProduction[] $mrpProductions
 * @property StockMove[] $stockMoves
 * @property ResUsers $writeU
 * @property StockJournal $stockJournal
 * @property SaleOrder $sale
 * @property PurchaseOrder $purchase
 * @property ResPartner $partner
 * @property StockLocation $location
 * @property StockLocation $locationDest
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property StockPicking $backorder
 * @property StockPicking[] $stockPickings
 * @property StockPartialMove[] $stockPartialMoves
 * @property StockPartialPicking[] $stockPartialPickings
 */
class StockPicking extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stock_picking';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('move_type, company_id, invoice_state, type', 'required'),
			array('create_uid, write_uid, partner_id, stock_journal_id, backorder_id, location_id, company_id, location_dest_id, purchase_id, sale_id', 'numerical', 'integerOnly'=>true),
			array('origin, name', 'length', 'max'=>64),
			array('create_date, write_date, date_done, min_date, date, note, state, max_date, auto_picking', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, origin, date_done, min_date, date, partner_id, stock_journal_id, backorder_id, name, location_id, move_type, company_id, invoice_state, note, state, location_dest_id, max_date, auto_picking, type, purchase_id, sale_id', 'safe', 'on'=>'search'),
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
			'mrpProductions' => array(self::HAS_MANY, 'MrpProduction', 'picking_id'),
			'stockMoves' => array(self::HAS_MANY, 'StockMove', 'picking_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'stockJournal' => array(self::BELONGS_TO, 'StockJournal', 'stock_journal_id'),
			'sale' => array(self::BELONGS_TO, 'SaleOrder', 'sale_id'),
			'purchase' => array(self::BELONGS_TO, 'PurchaseOrder', 'purchase_id'),
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'location' => array(self::BELONGS_TO, 'StockLocation', 'location_id'),
			'locationDest' => array(self::BELONGS_TO, 'StockLocation', 'location_dest_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'backorder' => array(self::BELONGS_TO, 'StockPicking', 'backorder_id'),
			'stockPickings' => array(self::HAS_MANY, 'StockPicking', 'backorder_id'),
			'stockPartialMoves' => array(self::HAS_MANY, 'StockPartialMove', 'picking_id'),
			'stockPartialPickings' => array(self::HAS_MANY, 'StockPartialPicking', 'picking_id'),
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
			'date_done' => 'Date Done',
			'min_date' => 'Min Date',
			'date' => 'Date',
			'partner_id' => 'Partner',
			'stock_journal_id' => 'Stock Journal',
			'backorder_id' => 'Backorder',
			'name' => 'Name',
			'location_id' => 'Location',
			'move_type' => 'Move Type',
			'company_id' => 'Company',
			'invoice_state' => 'Invoice State',
			'note' => 'Note',
			'state' => 'State',
			'location_dest_id' => 'Location Dest',
			'max_date' => 'Max Date',
			'auto_picking' => 'Auto Picking',
			'type' => 'Type',
			'purchase_id' => 'Purchase',
			'sale_id' => 'Sale',
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
		$criteria->compare('date_done',$this->date_done,true);
		$criteria->compare('min_date',$this->min_date,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('stock_journal_id',$this->stock_journal_id);
		$criteria->compare('backorder_id',$this->backorder_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('move_type',$this->move_type,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('invoice_state',$this->invoice_state,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('location_dest_id',$this->location_dest_id);
		$criteria->compare('max_date',$this->max_date,true);
		$criteria->compare('auto_picking',$this->auto_picking);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('purchase_id',$this->purchase_id);
		$criteria->compare('sale_id',$this->sale_id);

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
	 * @return StockPicking the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
