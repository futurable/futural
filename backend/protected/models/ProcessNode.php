<?php

/**
 * This is the model class for table "process_node".
 *
 * The followings are the available columns in table 'process_node':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $menu_id
 * @property integer $model_id
 * @property string $kind
 * @property string $note
 * @property string $name
 * @property integer $subflow_id
 * @property integer $process_id
 * @property string $model_states
 * @property string $help_url
 * @property boolean $flow_start
 *
 * The followings are the available model relations:
 * @property ProcessCondition[] $processConditions
 * @property ProcessTransition[] $processTransitions
 * @property ProcessTransition[] $processTransitions1
 * @property ResUsers $writeU
 * @property ProcessProcess $subflow
 * @property ProcessProcess $process
 * @property IrModel $model
 * @property IrUiMenu $menu
 * @property ResUsers $createU
 */
class ProcessNode extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'process_node';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kind, name, process_id', 'required'),
			array('create_uid, write_uid, menu_id, model_id, subflow_id, process_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>30),
			array('model_states', 'length', 'max'=>128),
			array('help_url', 'length', 'max'=>255),
			array('create_date, write_date, note, flow_start', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, menu_id, model_id, kind, note, name, subflow_id, process_id, model_states, help_url, flow_start', 'safe', 'on'=>'search'),
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
			'processConditions' => array(self::HAS_MANY, 'ProcessCondition', 'node_id'),
			'processTransitions' => array(self::HAS_MANY, 'ProcessTransition', 'target_node_id'),
			'processTransitions1' => array(self::HAS_MANY, 'ProcessTransition', 'source_node_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'subflow' => array(self::BELONGS_TO, 'ProcessProcess', 'subflow_id'),
			'process' => array(self::BELONGS_TO, 'ProcessProcess', 'process_id'),
			'model' => array(self::BELONGS_TO, 'IrModel', 'model_id'),
			'menu' => array(self::BELONGS_TO, 'IrUiMenu', 'menu_id'),
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
			'menu_id' => 'Menu',
			'model_id' => 'Model',
			'kind' => 'Kind',
			'note' => 'Note',
			'name' => 'Name',
			'subflow_id' => 'Subflow',
			'process_id' => 'Process',
			'model_states' => 'Model States',
			'help_url' => 'Help Url',
			'flow_start' => 'Flow Start',
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
		$criteria->compare('menu_id',$this->menu_id);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('kind',$this->kind,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('subflow_id',$this->subflow_id);
		$criteria->compare('process_id',$this->process_id);
		$criteria->compare('model_states',$this->model_states,true);
		$criteria->compare('help_url',$this->help_url,true);
		$criteria->compare('flow_start',$this->flow_start);

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
	 * @return ProcessNode the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
