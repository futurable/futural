<?php

/**
 * This is the model class for table "stock_inventory_line_split_lines".
 *
 * The followings are the available columns in table 'stock_inventory_line_split_lines':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $prodlot_id
 * @property integer $wizard_exist_id
 * @property string $name
 * @property integer $wizard_id
 * @property string $quantity
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property StockInventoryLineSplit $wizard
 * @property StockInventoryLineSplit $wizardExist
 * @property StockProductionLot $prodlot
 * @property ResUsers $createU
 */
class StockInventoryLineSplitLines extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stock_inventory_line_split_lines';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_uid, write_uid, prodlot_id, wizard_exist_id, wizard_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, quantity', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, prodlot_id, wizard_exist_id, name, wizard_id, quantity', 'safe', 'on'=>'search'),
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
			'wizard' => array(self::BELONGS_TO, 'StockInventoryLineSplit', 'wizard_id'),
			'wizardExist' => array(self::BELONGS_TO, 'StockInventoryLineSplit', 'wizard_exist_id'),
			'prodlot' => array(self::BELONGS_TO, 'StockProductionLot', 'prodlot_id'),
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
			'prodlot_id' => 'Prodlot',
			'wizard_exist_id' => 'Wizard Exist',
			'name' => 'Name',
			'wizard_id' => 'Wizard',
			'quantity' => 'Quantity',
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
		$criteria->compare('prodlot_id',$this->prodlot_id);
		$criteria->compare('wizard_exist_id',$this->wizard_exist_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('wizard_id',$this->wizard_id);
		$criteria->compare('quantity',$this->quantity,true);

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
	 * @return StockInventoryLineSplitLines the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
