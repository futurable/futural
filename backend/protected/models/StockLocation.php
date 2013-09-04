<?php

/**
 * This is the model class for table "stock_location".
 *
 * The followings are the available columns in table 'stock_location':
 * @property integer $id
 * @property integer $parent_left
 * @property integer $parent_right
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $comment
 * @property integer $chained_delay
 * @property integer $chained_company_id
 * @property boolean $active
 * @property integer $posz
 * @property integer $posx
 * @property integer $posy
 * @property integer $valuation_in_account_id
 * @property integer $partner_id
 * @property string $icon
 * @property integer $valuation_out_account_id
 * @property boolean $scrap_location
 * @property string $name
 * @property integer $chained_location_id
 * @property integer $chained_journal_id
 * @property string $chained_picking_type
 * @property integer $company_id
 * @property string $chained_auto_packing
 * @property string $complete_name
 * @property string $usage
 * @property integer $location_id
 * @property string $chained_location_type
 *
 * The followings are the available model relations:
 * @property MrpRouting[] $mrpRoutings
 * @property MrpProduction[] $mrpProductions
 * @property MrpProduction[] $mrpProductions1
 * @property ProcurementOrder[] $procurementOrders
 * @property PurchaseOrder[] $purchaseOrders
 * @property StockMove[] $stockMoves
 * @property StockMove[] $stockMoves1
 * @property StockInventoryLine[] $stockInventoryLines
 * @property StockPicking[] $stockPickings
 * @property StockPicking[] $stockPickings1
 * @property StockMoveConsume[] $stockMoveConsumes
 * @property StockInventoryLineSplit[] $stockInventoryLineSplits
 * @property StockMoveScrap[] $stockMoveScraps
 * @property StockFillInventory[] $stockFillInventories
 * @property StockChangeProductQty[] $stockChangeProductQties
 * @property StockPartialPickingLine[] $stockPartialPickingLines
 * @property StockPartialPickingLine[] $stockPartialPickingLines1
 * @property StockWarehouseOrderpoint[] $stockWarehouseOrderpoints
 * @property StockMoveSplit[] $stockMoveSplits
 * @property ResUsers $writeU
 * @property AccountAccount $valuationOutAccount
 * @property AccountAccount $valuationInAccount
 * @property ResPartner $partner
 * @property StockLocation $location
 * @property StockLocation[] $stockLocations
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property StockLocation $chainedLocation
 * @property StockLocation[] $stockLocations1
 * @property StockJournal $chainedJournal
 * @property ResCompany $chainedCompany
 * @property StockPartialMoveLine[] $stockPartialMoveLines
 * @property StockPartialMoveLine[] $stockPartialMoveLines1
 * @property StockWarehouse[] $stockWarehouses
 * @property StockWarehouse[] $stockWarehouses1
 * @property StockWarehouse[] $stockWarehouses2
 */
class StockLocation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stock_location';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, chained_auto_packing, usage, chained_location_type', 'required'),
			array('parent_left, parent_right, create_uid, write_uid, chained_delay, chained_company_id, posz, posx, posy, valuation_in_account_id, partner_id, valuation_out_account_id, chained_location_id, chained_journal_id, company_id, location_id', 'numerical', 'integerOnly'=>true),
			array('icon, name', 'length', 'max'=>64),
			array('complete_name', 'length', 'max'=>256),
			array('create_date, write_date, comment, active, scrap_location, chained_picking_type', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_left, parent_right, create_uid, create_date, write_date, write_uid, comment, chained_delay, chained_company_id, active, posz, posx, posy, valuation_in_account_id, partner_id, icon, valuation_out_account_id, scrap_location, name, chained_location_id, chained_journal_id, chained_picking_type, company_id, chained_auto_packing, complete_name, usage, location_id, chained_location_type', 'safe', 'on'=>'search'),
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
			'mrpRoutings' => array(self::HAS_MANY, 'MrpRouting', 'location_id'),
			'mrpProductions' => array(self::HAS_MANY, 'MrpProduction', 'location_src_id'),
			'mrpProductions1' => array(self::HAS_MANY, 'MrpProduction', 'location_dest_id'),
			'procurementOrders' => array(self::HAS_MANY, 'ProcurementOrder', 'location_id'),
			'purchaseOrders' => array(self::HAS_MANY, 'PurchaseOrder', 'location_id'),
			'stockMoves' => array(self::HAS_MANY, 'StockMove', 'location_id'),
			'stockMoves1' => array(self::HAS_MANY, 'StockMove', 'location_dest_id'),
			'stockInventoryLines' => array(self::HAS_MANY, 'StockInventoryLine', 'location_id'),
			'stockPickings' => array(self::HAS_MANY, 'StockPicking', 'location_id'),
			'stockPickings1' => array(self::HAS_MANY, 'StockPicking', 'location_dest_id'),
			'stockMoveConsumes' => array(self::HAS_MANY, 'StockMoveConsume', 'location_id'),
			'stockInventoryLineSplits' => array(self::HAS_MANY, 'StockInventoryLineSplit', 'location_id'),
			'stockMoveScraps' => array(self::HAS_MANY, 'StockMoveScrap', 'location_id'),
			'stockFillInventories' => array(self::HAS_MANY, 'StockFillInventory', 'location_id'),
			'stockChangeProductQties' => array(self::HAS_MANY, 'StockChangeProductQty', 'location_id'),
			'stockPartialPickingLines' => array(self::HAS_MANY, 'StockPartialPickingLine', 'location_id'),
			'stockPartialPickingLines1' => array(self::HAS_MANY, 'StockPartialPickingLine', 'location_dest_id'),
			'stockWarehouseOrderpoints' => array(self::HAS_MANY, 'StockWarehouseOrderpoint', 'location_id'),
			'stockMoveSplits' => array(self::HAS_MANY, 'StockMoveSplit', 'location_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'valuationOutAccount' => array(self::BELONGS_TO, 'AccountAccount', 'valuation_out_account_id'),
			'valuationInAccount' => array(self::BELONGS_TO, 'AccountAccount', 'valuation_in_account_id'),
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'location' => array(self::BELONGS_TO, 'StockLocation', 'location_id'),
			'stockLocations' => array(self::HAS_MANY, 'StockLocation', 'location_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'chainedLocation' => array(self::BELONGS_TO, 'StockLocation', 'chained_location_id'),
			'stockLocations1' => array(self::HAS_MANY, 'StockLocation', 'chained_location_id'),
			'chainedJournal' => array(self::BELONGS_TO, 'StockJournal', 'chained_journal_id'),
			'chainedCompany' => array(self::BELONGS_TO, 'ResCompany', 'chained_company_id'),
			'stockPartialMoveLines' => array(self::HAS_MANY, 'StockPartialMoveLine', 'location_id'),
			'stockPartialMoveLines1' => array(self::HAS_MANY, 'StockPartialMoveLine', 'location_dest_id'),
			'stockWarehouses' => array(self::HAS_MANY, 'StockWarehouse', 'lot_stock_id'),
			'stockWarehouses1' => array(self::HAS_MANY, 'StockWarehouse', 'lot_output_id'),
			'stockWarehouses2' => array(self::HAS_MANY, 'StockWarehouse', 'lot_input_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_left' => 'Parent Left',
			'parent_right' => 'Parent Right',
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'comment' => 'Comment',
			'chained_delay' => 'Chained Delay',
			'chained_company_id' => 'Chained Company',
			'active' => 'Active',
			'posz' => 'Posz',
			'posx' => 'Posx',
			'posy' => 'Posy',
			'valuation_in_account_id' => 'Valuation In Account',
			'partner_id' => 'Partner',
			'icon' => 'Icon',
			'valuation_out_account_id' => 'Valuation Out Account',
			'scrap_location' => 'Scrap Location',
			'name' => 'Name',
			'chained_location_id' => 'Chained Location',
			'chained_journal_id' => 'Chained Journal',
			'chained_picking_type' => 'Chained Picking Type',
			'company_id' => 'Company',
			'chained_auto_packing' => 'Chained Auto Packing',
			'complete_name' => 'Complete Name',
			'usage' => 'Usage',
			'location_id' => 'Location',
			'chained_location_type' => 'Chained Location Type',
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
		$criteria->compare('parent_left',$this->parent_left);
		$criteria->compare('parent_right',$this->parent_right);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('chained_delay',$this->chained_delay);
		$criteria->compare('chained_company_id',$this->chained_company_id);
		$criteria->compare('active',$this->active);
		$criteria->compare('posz',$this->posz);
		$criteria->compare('posx',$this->posx);
		$criteria->compare('posy',$this->posy);
		$criteria->compare('valuation_in_account_id',$this->valuation_in_account_id);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('valuation_out_account_id',$this->valuation_out_account_id);
		$criteria->compare('scrap_location',$this->scrap_location);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('chained_location_id',$this->chained_location_id);
		$criteria->compare('chained_journal_id',$this->chained_journal_id);
		$criteria->compare('chained_picking_type',$this->chained_picking_type,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('chained_auto_packing',$this->chained_auto_packing,true);
		$criteria->compare('complete_name',$this->complete_name,true);
		$criteria->compare('usage',$this->usage,true);
		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('chained_location_type',$this->chained_location_type,true);

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
	 * @return StockLocation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
