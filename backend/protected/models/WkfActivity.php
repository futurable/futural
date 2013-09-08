<?php

/**
 * This is the model class for table "wkf_activity".
 *
 * The followings are the available columns in table 'wkf_activity':
 * @property integer $id
 * @property integer $wkf_id
 * @property integer $subflow_id
 * @property string $split_mode
 * @property string $join_mode
 * @property string $kind
 * @property string $name
 * @property string $signal_send
 * @property boolean $flow_start
 * @property boolean $flow_stop
 * @property string $action
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $action_id
 *
 * The followings are the available model relations:
 * @property WkfWorkitem[] $wkfWorkitems
 * @property WkfLogs[] $wkfLogs
 * @property WkfTransition[] $wkfTransitions
 * @property WkfTransition[] $wkfTransitions1
 * @property ResUsers $writeU
 * @property Wkf $wkf
 * @property Wkf $subflow
 * @property ResUsers $createU
 * @property IrActServer $action0
 */
class WkfActivity extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wkf_activity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('wkf_id, name', 'required'),
			array('wkf_id, subflow_id, create_uid, write_uid, action_id', 'numerical', 'integerOnly'=>true),
			array('split_mode, join_mode', 'length', 'max'=>3),
			array('kind', 'length', 'max'=>16),
			array('name', 'length', 'max'=>64),
			array('signal_send', 'length', 'max'=>32),
			array('flow_start, flow_stop, action, create_date, write_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, wkf_id, subflow_id, split_mode, join_mode, kind, name, signal_send, flow_start, flow_stop, action, create_uid, create_date, write_date, write_uid, action_id', 'safe', 'on'=>'search'),
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
			'wkfWorkitems' => array(self::HAS_MANY, 'WkfWorkitem', 'act_id'),
			'wkfLogs' => array(self::HAS_MANY, 'WkfLogs', 'act_id'),
			'wkfTransitions' => array(self::HAS_MANY, 'WkfTransition', 'act_to'),
			'wkfTransitions1' => array(self::HAS_MANY, 'WkfTransition', 'act_from'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'wkf' => array(self::BELONGS_TO, 'Wkf', 'wkf_id'),
			'subflow' => array(self::BELONGS_TO, 'Wkf', 'subflow_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'action0' => array(self::BELONGS_TO, 'IrActServer', 'action_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'wkf_id' => 'Wkf',
			'subflow_id' => 'Subflow',
			'split_mode' => 'Split Mode',
			'join_mode' => 'Join Mode',
			'kind' => 'Kind',
			'name' => 'Name',
			'signal_send' => 'Signal Send',
			'flow_start' => 'Flow Start',
			'flow_stop' => 'Flow Stop',
			'action' => 'Action',
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'action_id' => 'Action',
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
		$criteria->compare('wkf_id',$this->wkf_id);
		$criteria->compare('subflow_id',$this->subflow_id);
		$criteria->compare('split_mode',$this->split_mode,true);
		$criteria->compare('join_mode',$this->join_mode,true);
		$criteria->compare('kind',$this->kind,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('signal_send',$this->signal_send,true);
		$criteria->compare('flow_start',$this->flow_start);
		$criteria->compare('flow_stop',$this->flow_stop);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('action_id',$this->action_id);

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
	 * @return WkfActivity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
