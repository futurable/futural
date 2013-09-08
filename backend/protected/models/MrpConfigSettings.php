<?php

/**
 * This is the model class for table "mrp_config_settings".
 *
 * The followings are the available columns in table 'mrp_config_settings':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property boolean $module_mrp_byproduct
 * @property boolean $module_mrp_jit
 * @property boolean $group_mrp_properties
 * @property boolean $module_product_manufacturer
 * @property boolean $module_mrp_repair
 * @property boolean $module_mrp_operations
 * @property boolean $group_mrp_routings
 * @property boolean $module_stock_no_autopicking
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ResUsers $createU
 */
class MrpConfigSettings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mrp_config_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_uid, write_uid', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date, module_mrp_byproduct, module_mrp_jit, group_mrp_properties, module_product_manufacturer, module_mrp_repair, module_mrp_operations, group_mrp_routings, module_stock_no_autopicking', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, module_mrp_byproduct, module_mrp_jit, group_mrp_properties, module_product_manufacturer, module_mrp_repair, module_mrp_operations, group_mrp_routings, module_stock_no_autopicking', 'safe', 'on'=>'search'),
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
			'module_mrp_byproduct' => 'Module Mrp Byproduct',
			'module_mrp_jit' => 'Module Mrp Jit',
			'group_mrp_properties' => 'Group Mrp Properties',
			'module_product_manufacturer' => 'Module Product Manufacturer',
			'module_mrp_repair' => 'Module Mrp Repair',
			'module_mrp_operations' => 'Module Mrp Operations',
			'group_mrp_routings' => 'Group Mrp Routings',
			'module_stock_no_autopicking' => 'Module Stock No Autopicking',
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
		$criteria->compare('module_mrp_byproduct',$this->module_mrp_byproduct);
		$criteria->compare('module_mrp_jit',$this->module_mrp_jit);
		$criteria->compare('group_mrp_properties',$this->group_mrp_properties);
		$criteria->compare('module_product_manufacturer',$this->module_product_manufacturer);
		$criteria->compare('module_mrp_repair',$this->module_mrp_repair);
		$criteria->compare('module_mrp_operations',$this->module_mrp_operations);
		$criteria->compare('group_mrp_routings',$this->group_mrp_routings);
		$criteria->compare('module_stock_no_autopicking',$this->module_stock_no_autopicking);

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
	 * @return MrpConfigSettings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
