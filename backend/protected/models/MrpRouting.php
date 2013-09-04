<?php

/**
 * This is the model class for table "mrp_routing".
 *
 * The followings are the available columns in table 'mrp_routing':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $note
 * @property string $code
 * @property string $name
 * @property boolean $active
 * @property integer $location_id
 * @property integer $company_id
 *
 * The followings are the available model relations:
 * @property MrpBom[] $mrpBoms
 * @property MrpRoutingWorkcenter[] $mrpRoutingWorkcenters
 * @property ResUsers $writeU
 * @property StockLocation $location
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property MrpProduction[] $mrpProductions
 */
class MrpRouting extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mrp_routing';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('create_uid, write_uid, location_id, company_id', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>8),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, note, active', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, note, code, name, active, location_id, company_id', 'safe', 'on'=>'search'),
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
			'mrpBoms' => array(self::HAS_MANY, 'MrpBom', 'routing_id'),
			'mrpRoutingWorkcenters' => array(self::HAS_MANY, 'MrpRoutingWorkcenter', 'routing_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'location' => array(self::BELONGS_TO, 'StockLocation', 'location_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'mrpProductions' => array(self::HAS_MANY, 'MrpProduction', 'routing_id'),
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
			'note' => 'Note',
			'code' => 'Code',
			'name' => 'Name',
			'active' => 'Active',
			'location_id' => 'Location',
			'company_id' => 'Company',
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
		$criteria->compare('note',$this->note,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('company_id',$this->company_id);

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
	 * @return MrpRouting the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
