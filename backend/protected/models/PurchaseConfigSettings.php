<?php

/**
 * This is the model class for table "purchase_config_settings".
 *
 * The followings are the available columns in table 'purchase_config_settings':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property boolean $group_uom
 * @property boolean $module_purchase_analytic_plans
 * @property boolean $group_costing_method
 * @property boolean $module_purchase_requisition
 * @property string $default_invoice_method
 * @property boolean $module_purchase_double_validation
 * @property boolean $group_analytic_account_for_purchases
 * @property boolean $group_purchase_pricelist
 * @property boolean $module_warning
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ResUsers $createU
 */
class PurchaseConfigSettings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'purchase_config_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('default_invoice_method', 'required'),
			array('create_uid, write_uid', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date, group_uom, module_purchase_analytic_plans, group_costing_method, module_purchase_requisition, module_purchase_double_validation, group_analytic_account_for_purchases, group_purchase_pricelist, module_warning', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, group_uom, module_purchase_analytic_plans, group_costing_method, module_purchase_requisition, default_invoice_method, module_purchase_double_validation, group_analytic_account_for_purchases, group_purchase_pricelist, module_warning', 'safe', 'on'=>'search'),
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
			'group_uom' => 'Group Uom',
			'module_purchase_analytic_plans' => 'Module Purchase Analytic Plans',
			'group_costing_method' => 'Group Costing Method',
			'module_purchase_requisition' => 'Module Purchase Requisition',
			'default_invoice_method' => 'Default Invoice Method',
			'module_purchase_double_validation' => 'Module Purchase Double Validation',
			'group_analytic_account_for_purchases' => 'Group Analytic Account For Purchases',
			'group_purchase_pricelist' => 'Group Purchase Pricelist',
			'module_warning' => 'Module Warning',
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
		$criteria->compare('group_uom',$this->group_uom);
		$criteria->compare('module_purchase_analytic_plans',$this->module_purchase_analytic_plans);
		$criteria->compare('group_costing_method',$this->group_costing_method);
		$criteria->compare('module_purchase_requisition',$this->module_purchase_requisition);
		$criteria->compare('default_invoice_method',$this->default_invoice_method,true);
		$criteria->compare('module_purchase_double_validation',$this->module_purchase_double_validation);
		$criteria->compare('group_analytic_account_for_purchases',$this->group_analytic_account_for_purchases);
		$criteria->compare('group_purchase_pricelist',$this->group_purchase_pricelist);
		$criteria->compare('module_warning',$this->module_warning);

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
	 * @return PurchaseConfigSettings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
