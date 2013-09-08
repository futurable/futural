<?php

/**
 * This is the model class for table "mrp_routing_workcenter".
 *
 * The followings are the available columns in table 'mrp_routing_workcenter':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property double $cycle_nbr
 * @property string $name
 * @property integer $sequence
 * @property integer $company_id
 * @property string $note
 * @property integer $routing_id
 * @property integer $workcenter_id
 * @property double $hour_nbr
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property MrpWorkcenter $workcenter
 * @property MrpRouting $routing
 * @property ResUsers $createU
 */
class MrpRoutingWorkcenter extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mrp_routing_workcenter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cycle_nbr, name, workcenter_id, hour_nbr', 'required'),
			array('create_uid, write_uid, sequence, company_id, routing_id, workcenter_id', 'numerical', 'integerOnly'=>true),
			array('cycle_nbr, hour_nbr', 'numerical'),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, note', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, cycle_nbr, name, sequence, company_id, note, routing_id, workcenter_id, hour_nbr', 'safe', 'on'=>'search'),
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
			'workcenter' => array(self::BELONGS_TO, 'MrpWorkcenter', 'workcenter_id'),
			'routing' => array(self::BELONGS_TO, 'MrpRouting', 'routing_id'),
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
			'cycle_nbr' => 'Cycle Nbr',
			'name' => 'Name',
			'sequence' => 'Sequence',
			'company_id' => 'Company',
			'note' => 'Note',
			'routing_id' => 'Routing',
			'workcenter_id' => 'Workcenter',
			'hour_nbr' => 'Hour Nbr',
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
		$criteria->compare('cycle_nbr',$this->cycle_nbr);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('routing_id',$this->routing_id);
		$criteria->compare('workcenter_id',$this->workcenter_id);
		$criteria->compare('hour_nbr',$this->hour_nbr);

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
	 * @return MrpRoutingWorkcenter the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
