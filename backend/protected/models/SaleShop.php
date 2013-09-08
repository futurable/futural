<?php

/**
 * This is the model class for table "sale_shop".
 *
 * The followings are the available columns in table 'sale_shop':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $pricelist_id
 * @property integer $project_id
 * @property string $name
 * @property integer $payment_default_id
 * @property integer $company_id
 * @property integer $warehouse_id
 *
 * The followings are the available model relations:
 * @property CrmMakeSale[] $crmMakeSales
 * @property SaleOrder[] $saleOrders
 * @property ResUsers $writeU
 * @property StockWarehouse $warehouse
 * @property AccountAnalyticAccount $project
 * @property ProductPricelist $pricelist
 * @property AccountPaymentTerm $paymentDefault
 * @property ResUsers $createU
 * @property ResCompany $company
 */
class SaleShop extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sale_shop';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, payment_default_id', 'required'),
			array('create_uid, write_uid, pricelist_id, project_id, payment_default_id, company_id, warehouse_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, pricelist_id, project_id, name, payment_default_id, company_id, warehouse_id', 'safe', 'on'=>'search'),
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
			'crmMakeSales' => array(self::HAS_MANY, 'CrmMakeSale', 'shop_id'),
			'saleOrders' => array(self::HAS_MANY, 'SaleOrder', 'shop_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'warehouse' => array(self::BELONGS_TO, 'StockWarehouse', 'warehouse_id'),
			'project' => array(self::BELONGS_TO, 'AccountAnalyticAccount', 'project_id'),
			'pricelist' => array(self::BELONGS_TO, 'ProductPricelist', 'pricelist_id'),
			'paymentDefault' => array(self::BELONGS_TO, 'AccountPaymentTerm', 'payment_default_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
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
			'pricelist_id' => 'Pricelist',
			'project_id' => 'Project',
			'name' => 'Name',
			'payment_default_id' => 'Payment Default',
			'company_id' => 'Company',
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
		$criteria->compare('pricelist_id',$this->pricelist_id);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('payment_default_id',$this->payment_default_id);
		$criteria->compare('company_id',$this->company_id);
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
	 * @return SaleShop the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
