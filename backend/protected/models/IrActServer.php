<?php

/**
 * This is the model class for table "ir_act_server".
 *
 * The followings are the available columns in table 'ir_act_server':
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $usage
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $help
 * @property integer $model_id
 * @property string $code
 * @property integer $sequence
 * @property string $sms
 * @property string $write_id
 * @property integer $srcmodel_id
 * @property string $message
 * @property string $trigger_name
 * @property string $condition
 * @property string $subject
 * @property integer $loop_action
 * @property integer $trigger_obj_id
 * @property string $mobile
 * @property string $copy_object
 * @property integer $wkf_model_id
 * @property string $state
 * @property integer $record_id
 * @property string $expression
 * @property string $email
 * @property integer $action_id
 *
 * The followings are the available model relations:
 * @property FetchmailServer[] $fetchmailServers
 * @property IrServerObjectLines[] $irServerObjectLines
 * @property RelServerActions[] $relServerActions
 * @property RelServerActions[] $relServerActions1
 * @property BaseActionRuleIrActServerRel[] $baseActionRuleIrActServerRels
 * @property IrModel $wkfModel
 * @property IrModelFields $triggerObj
 * @property IrModel $srcmodel
 * @property IrModelFields $record
 * @property IrModel $model
 * @property IrActServer $loopAction
 * @property IrActServer[] $irActServers
 * @property WkfActivity[] $wkfActivities
 */
class IrActServer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_act_server';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, model_id, condition, state', 'required'),
			array('create_uid, write_uid, model_id, sequence, srcmodel_id, loop_action, trigger_obj_id, wkf_model_id, record_id, action_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('type, usage, state', 'length', 'max'=>32),
			array('sms', 'length', 'max'=>160),
			array('write_id, condition, copy_object', 'length', 'max'=>256),
			array('trigger_name', 'length', 'max'=>128),
			array('subject', 'length', 'max'=>1024),
			array('mobile, expression, email', 'length', 'max'=>512),
			array('create_date, write_date, help, code, message', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, type, usage, create_uid, create_date, write_date, write_uid, help, model_id, code, sequence, sms, write_id, srcmodel_id, message, trigger_name, condition, subject, loop_action, trigger_obj_id, mobile, copy_object, wkf_model_id, state, record_id, expression, email, action_id', 'safe', 'on'=>'search'),
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
			'fetchmailServers' => array(self::HAS_MANY, 'FetchmailServer', 'action_id'),
			'irServerObjectLines' => array(self::HAS_MANY, 'IrServerObjectLines', 'server_id'),
			'relServerActions' => array(self::HAS_MANY, 'RelServerActions', 'server_id'),
			'relServerActions1' => array(self::HAS_MANY, 'RelServerActions', 'action_id'),
			'baseActionRuleIrActServerRels' => array(self::HAS_MANY, 'BaseActionRuleIrActServerRel', 'ir_act_server_id'),
			'wkfModel' => array(self::BELONGS_TO, 'IrModel', 'wkf_model_id'),
			'triggerObj' => array(self::BELONGS_TO, 'IrModelFields', 'trigger_obj_id'),
			'srcmodel' => array(self::BELONGS_TO, 'IrModel', 'srcmodel_id'),
			'record' => array(self::BELONGS_TO, 'IrModelFields', 'record_id'),
			'model' => array(self::BELONGS_TO, 'IrModel', 'model_id'),
			'loopAction' => array(self::BELONGS_TO, 'IrActServer', 'loop_action'),
			'irActServers' => array(self::HAS_MANY, 'IrActServer', 'loop_action'),
			'wkfActivities' => array(self::HAS_MANY, 'WkfActivity', 'action_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'type' => 'Type',
			'usage' => 'Usage',
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'help' => 'Help',
			'model_id' => 'Model',
			'code' => 'Code',
			'sequence' => 'Sequence',
			'sms' => 'Sms',
			'write_id' => 'Write',
			'srcmodel_id' => 'Srcmodel',
			'message' => 'Message',
			'trigger_name' => 'Trigger Name',
			'condition' => 'Condition',
			'subject' => 'Subject',
			'loop_action' => 'Loop Action',
			'trigger_obj_id' => 'Trigger Obj',
			'mobile' => 'Mobile',
			'copy_object' => 'Copy Object',
			'wkf_model_id' => 'Wkf Model',
			'state' => 'State',
			'record_id' => 'Record',
			'expression' => 'Expression',
			'email' => 'Email',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('usage',$this->usage,true);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('help',$this->help,true);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('sms',$this->sms,true);
		$criteria->compare('write_id',$this->write_id,true);
		$criteria->compare('srcmodel_id',$this->srcmodel_id);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('trigger_name',$this->trigger_name,true);
		$criteria->compare('condition',$this->condition,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('loop_action',$this->loop_action);
		$criteria->compare('trigger_obj_id',$this->trigger_obj_id);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('copy_object',$this->copy_object,true);
		$criteria->compare('wkf_model_id',$this->wkf_model_id);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('record_id',$this->record_id);
		$criteria->compare('expression',$this->expression,true);
		$criteria->compare('email',$this->email,true);
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
	 * @return IrActServer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
