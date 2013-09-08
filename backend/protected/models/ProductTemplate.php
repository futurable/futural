<?php

/**
 * This is the model class for table "product_template".
 *
 * The followings are the available columns in table 'product_template':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property double $warranty
 * @property integer $uos_id
 * @property string $list_price
 * @property string $description
 * @property string $weight
 * @property string $weight_net
 * @property string $standard_price
 * @property string $mes_type
 * @property integer $uom_id
 * @property string $description_purchase
 * @property string $cost_method
 * @property integer $categ_id
 * @property string $name
 * @property string $uos_coeff
 * @property double $volume
 * @property boolean $sale_ok
 * @property string $description_sale
 * @property integer $product_manager
 * @property integer $company_id
 * @property string $state
 * @property double $produce_delay
 * @property integer $uom_po_id
 * @property boolean $rental
 * @property string $type
 * @property string $loc_rack
 * @property string $loc_row
 * @property double $sale_delay
 * @property string $loc_case
 * @property string $supply_method
 * @property string $procure_method
 * @property boolean $purchase_ok
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ProductUom $uos
 * @property ProductUom $uomPo
 * @property ProductUom $uom
 * @property ResUsers $productManager
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property ProductCategory $categ
 * @property ProductPricelistItem[] $productPricelistItems
 * @property ProductSupplierTaxesRel[] $productSupplierTaxesRels
 * @property ProductTaxesRel[] $productTaxesRels
 * @property ProductProduct[] $productProducts
 * @property ProductSupplierinfo[] $productSupplierinfos
 */
class ProductTemplate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_template';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uom_id, cost_method, categ_id, name, uom_po_id, type, supply_method, procure_method', 'required'),
			array('create_uid, write_uid, uos_id, uom_id, categ_id, product_manager, company_id, uom_po_id', 'numerical', 'integerOnly'=>true),
			array('warranty, volume, produce_delay, sale_delay', 'numerical'),
			array('name', 'length', 'max'=>128),
			array('loc_rack, loc_row, loc_case', 'length', 'max'=>16),
			array('create_date, write_date, list_price, description, weight, weight_net, standard_price, mes_type, description_purchase, uos_coeff, sale_ok, description_sale, state, rental, purchase_ok', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, warranty, uos_id, list_price, description, weight, weight_net, standard_price, mes_type, uom_id, description_purchase, cost_method, categ_id, name, uos_coeff, volume, sale_ok, description_sale, product_manager, company_id, state, produce_delay, uom_po_id, rental, type, loc_rack, loc_row, sale_delay, loc_case, supply_method, procure_method, purchase_ok', 'safe', 'on'=>'search'),
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
			'uos' => array(self::BELONGS_TO, 'ProductUom', 'uos_id'),
			'uomPo' => array(self::BELONGS_TO, 'ProductUom', 'uom_po_id'),
			'uom' => array(self::BELONGS_TO, 'ProductUom', 'uom_id'),
			'productManager' => array(self::BELONGS_TO, 'ResUsers', 'product_manager'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'categ' => array(self::BELONGS_TO, 'ProductCategory', 'categ_id'),
			'productPricelistItems' => array(self::HAS_MANY, 'ProductPricelistItem', 'product_tmpl_id'),
			'productSupplierTaxesRels' => array(self::HAS_MANY, 'ProductSupplierTaxesRel', 'prod_id'),
			'productTaxesRels' => array(self::HAS_MANY, 'ProductTaxesRel', 'prod_id'),
			'productProducts' => array(self::HAS_MANY, 'ProductProduct', 'product_tmpl_id'),
			'productSupplierinfos' => array(self::HAS_MANY, 'ProductSupplierinfo', 'product_id'),
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
			'warranty' => 'Warranty',
			'uos_id' => 'Uos',
			'list_price' => 'List Price',
			'description' => 'Description',
			'weight' => 'Weight',
			'weight_net' => 'Weight Net',
			'standard_price' => 'Standard Price',
			'mes_type' => 'Mes Type',
			'uom_id' => 'Uom',
			'description_purchase' => 'Description Purchase',
			'cost_method' => 'Cost Method',
			'categ_id' => 'Categ',
			'name' => 'Name',
			'uos_coeff' => 'Uos Coeff',
			'volume' => 'Volume',
			'sale_ok' => 'Sale Ok',
			'description_sale' => 'Description Sale',
			'product_manager' => 'Product Manager',
			'company_id' => 'Company',
			'state' => 'State',
			'produce_delay' => 'Produce Delay',
			'uom_po_id' => 'Uom Po',
			'rental' => 'Rental',
			'type' => 'Type',
			'loc_rack' => 'Loc Rack',
			'loc_row' => 'Loc Row',
			'sale_delay' => 'Sale Delay',
			'loc_case' => 'Loc Case',
			'supply_method' => 'Supply Method',
			'procure_method' => 'Procure Method',
			'purchase_ok' => 'Purchase Ok',
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
		$criteria->compare('warranty',$this->warranty);
		$criteria->compare('uos_id',$this->uos_id);
		$criteria->compare('list_price',$this->list_price,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('weight',$this->weight,true);
		$criteria->compare('weight_net',$this->weight_net,true);
		$criteria->compare('standard_price',$this->standard_price,true);
		$criteria->compare('mes_type',$this->mes_type,true);
		$criteria->compare('uom_id',$this->uom_id);
		$criteria->compare('description_purchase',$this->description_purchase,true);
		$criteria->compare('cost_method',$this->cost_method,true);
		$criteria->compare('categ_id',$this->categ_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('uos_coeff',$this->uos_coeff,true);
		$criteria->compare('volume',$this->volume);
		$criteria->compare('sale_ok',$this->sale_ok);
		$criteria->compare('description_sale',$this->description_sale,true);
		$criteria->compare('product_manager',$this->product_manager);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('produce_delay',$this->produce_delay);
		$criteria->compare('uom_po_id',$this->uom_po_id);
		$criteria->compare('rental',$this->rental);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('loc_rack',$this->loc_rack,true);
		$criteria->compare('loc_row',$this->loc_row,true);
		$criteria->compare('sale_delay',$this->sale_delay);
		$criteria->compare('loc_case',$this->loc_case,true);
		$criteria->compare('supply_method',$this->supply_method,true);
		$criteria->compare('procure_method',$this->procure_method,true);
		$criteria->compare('purchase_ok',$this->purchase_ok);

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
	 * @return ProductTemplate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
