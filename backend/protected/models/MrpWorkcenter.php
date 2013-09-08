<?php

/**
 * This is the model class for table "mrp_workcenter".
 *
 * The followings are the available columns in table 'mrp_workcenter':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $costs_cycle_account_id
 * @property double $capacity_per_cycle
 * @property double $time_start
 * @property integer $product_id
 * @property integer $resource_id
 * @property integer $costs_journal_id
 * @property double $time_stop
 * @property string $note
 * @property double $costs_hour
 * @property integer $costs_hour_account_id
 * @property double $costs_cycle
 * @property integer $costs_general_account_id
 * @property double $time_cycle
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ResourceResource $resource
 * @property ProductProduct $product
 * @property ResUsers $createU
 * @property AccountAnalyticJournal $costsJournal
 * @property AccountAnalyticAccount $costsHourAccount
 * @property AccountAccount $costsGeneralAccount
 * @property AccountAnalyticAccount $costsCycleAccount
 * @property MrpRoutingWorkcenter[] $mrpRoutingWorkcenters
 * @property MrpProductionWorkcenterLine[] $mrpProductionWorkcenterLines
 */
class MrpWorkcenter extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mrp_workcenter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('resource_id', 'required'),
			array('create_uid, write_uid, costs_cycle_account_id, product_id, resource_id, costs_journal_id, costs_hour_account_id, costs_general_account_id', 'numerical', 'integerOnly'=>true),
			array('capacity_per_cycle, time_start, time_stop, costs_hour, costs_cycle, time_cycle', 'numerical'),
			array('create_date, write_date, note', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, costs_cycle_account_id, capacity_per_cycle, time_start, product_id, resource_id, costs_journal_id, time_stop, note, costs_hour, costs_hour_account_id, costs_cycle, costs_general_account_id, time_cycle', 'safe', 'on'=>'search'),
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
			'resource' => array(self::BELONGS_TO, 'ResourceResource', 'resource_id'),
			'product' => array(self::BELONGS_TO, 'ProductProduct', 'product_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'costsJournal' => array(self::BELONGS_TO, 'AccountAnalyticJournal', 'costs_journal_id'),
			'costsHourAccount' => array(self::BELONGS_TO, 'AccountAnalyticAccount', 'costs_hour_account_id'),
			'costsGeneralAccount' => array(self::BELONGS_TO, 'AccountAccount', 'costs_general_account_id'),
			'costsCycleAccount' => array(self::BELONGS_TO, 'AccountAnalyticAccount', 'costs_cycle_account_id'),
			'mrpRoutingWorkcenters' => array(self::HAS_MANY, 'MrpRoutingWorkcenter', 'workcenter_id'),
			'mrpProductionWorkcenterLines' => array(self::HAS_MANY, 'MrpProductionWorkcenterLine', 'workcenter_id'),
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
			'costs_cycle_account_id' => 'Costs Cycle Account',
			'capacity_per_cycle' => 'Capacity Per Cycle',
			'time_start' => 'Time Start',
			'product_id' => 'Product',
			'resource_id' => 'Resource',
			'costs_journal_id' => 'Costs Journal',
			'time_stop' => 'Time Stop',
			'note' => 'Note',
			'costs_hour' => 'Costs Hour',
			'costs_hour_account_id' => 'Costs Hour Account',
			'costs_cycle' => 'Costs Cycle',
			'costs_general_account_id' => 'Costs General Account',
			'time_cycle' => 'Time Cycle',
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
		$criteria->compare('costs_cycle_account_id',$this->costs_cycle_account_id);
		$criteria->compare('capacity_per_cycle',$this->capacity_per_cycle);
		$criteria->compare('time_start',$this->time_start);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('resource_id',$this->resource_id);
		$criteria->compare('costs_journal_id',$this->costs_journal_id);
		$criteria->compare('time_stop',$this->time_stop);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('costs_hour',$this->costs_hour);
		$criteria->compare('costs_hour_account_id',$this->costs_hour_account_id);
		$criteria->compare('costs_cycle',$this->costs_cycle);
		$criteria->compare('costs_general_account_id',$this->costs_general_account_id);
		$criteria->compare('time_cycle',$this->time_cycle);

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
	 * @return MrpWorkcenter the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
