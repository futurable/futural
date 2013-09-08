<?php

/**
 * This is the model class for table "mrp_property".
 *
 * The followings are the available columns in table 'mrp_property':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $composition
 * @property integer $group_id
 * @property string $description
 * @property string $name
 *
 * The followings are the available model relations:
 * @property MrpBomPropertyRel[] $mrpBomPropertyRels
 * @property ProcurementPropertyRel[] $procurementPropertyRels
 * @property SaleOrderLinePropertyRel[] $saleOrderLinePropertyRels
 * @property ResUsers $writeU
 * @property MrpPropertyGroup $group
 * @property ResUsers $createU
 */
class MrpProperty extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mrp_property';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('composition, group_id, name', 'required'),
			array('create_uid, write_uid, group_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, composition, group_id, description, name', 'safe', 'on'=>'search'),
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
			'mrpBomPropertyRels' => array(self::HAS_MANY, 'MrpBomPropertyRel', 'property_id'),
			'procurementPropertyRels' => array(self::HAS_MANY, 'ProcurementPropertyRel', 'property_id'),
			'saleOrderLinePropertyRels' => array(self::HAS_MANY, 'SaleOrderLinePropertyRel', 'property_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'group' => array(self::BELONGS_TO, 'MrpPropertyGroup', 'group_id'),
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
			'composition' => 'Composition',
			'group_id' => 'Group',
			'description' => 'Description',
			'name' => 'Name',
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
		$criteria->compare('composition',$this->composition,true);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('name',$this->name,true);

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
	 * @return MrpProperty the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
