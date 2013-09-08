<?php

/**
 * This is the model class for table "ir_model".
 *
 * The followings are the available columns in table 'ir_model':
 * @property integer $id
 * @property string $model
 * @property string $name
 * @property string $state
 * @property string $info
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 *
 * The followings are the available model relations:
 * @property BaseActionRule[] $baseActionRules
 * @property CrmCaseCateg[] $crmCaseCategs
 * @property EmailTemplate[] $emailTemplates
 * @property EmailTemplate[] $emailTemplates1
 * @property EmailTemplatePreview[] $emailTemplatePreviews
 * @property EmailTemplatePreview[] $emailTemplatePreviews1
 * @property FetchmailServer[] $fetchmailServers
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property IrModelConstraint[] $irModelConstraints
 * @property IrModelFields[] $irModelFields
 * @property IrModelRelation[] $irModelRelations
 * @property IrRule[] $irRules
 * @property IrValues[] $irValues
 * @property MailAlias[] $mailAliases
 * @property MultiCompanyDefault[] $multiCompanyDefaults
 * @property ProcessCondition[] $processConditions
 * @property ProcessProcess[] $processProcesses
 * @property CalendarAlarm[] $calendarAlarms
 * @property ProcessNode[] $processNodes
 * @property IrModelAccess[] $irModelAccesses
 * @property IrActServer[] $irActServers
 * @property IrActServer[] $irActServers1
 * @property IrActServer[] $irActServers2
 */
class IrModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_model';
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
			array('create_uid, write_uid', 'numerical', 'integerOnly'=>true),
			array('model, name', 'length', 'max'=>64),
			array('state', 'length', 'max'=>16),
			array('info, create_date, write_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, model, name, state, info, create_uid, create_date, write_date, write_uid', 'safe', 'on'=>'search'),
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
			'baseActionRules' => array(self::HAS_MANY, 'BaseActionRule', 'model_id'),
			'crmCaseCategs' => array(self::HAS_MANY, 'CrmCaseCateg', 'object_id'),
			'emailTemplates' => array(self::HAS_MANY, 'EmailTemplate', 'sub_object'),
			'emailTemplates1' => array(self::HAS_MANY, 'EmailTemplate', 'model_id'),
			'emailTemplatePreviews' => array(self::HAS_MANY, 'EmailTemplatePreview', 'sub_object'),
			'emailTemplatePreviews1' => array(self::HAS_MANY, 'EmailTemplatePreview', 'model_id'),
			'fetchmailServers' => array(self::HAS_MANY, 'FetchmailServer', 'object_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'irModelConstraints' => array(self::HAS_MANY, 'IrModelConstraint', 'model'),
			'irModelFields' => array(self::HAS_MANY, 'IrModelFields', 'model_id'),
			'irModelRelations' => array(self::HAS_MANY, 'IrModelRelation', 'model'),
			'irRules' => array(self::HAS_MANY, 'IrRule', 'model_id'),
			'irValues' => array(self::HAS_MANY, 'IrValues', 'model_id'),
			'mailAliases' => array(self::HAS_MANY, 'MailAlias', 'alias_model_id'),
			'multiCompanyDefaults' => array(self::HAS_MANY, 'MultiCompanyDefault', 'object_id'),
			'processConditions' => array(self::HAS_MANY, 'ProcessCondition', 'model_id'),
			'processProcesses' => array(self::HAS_MANY, 'ProcessProcess', 'model_id'),
			'calendarAlarms' => array(self::HAS_MANY, 'CalendarAlarm', 'model_id'),
			'processNodes' => array(self::HAS_MANY, 'ProcessNode', 'model_id'),
			'irModelAccesses' => array(self::HAS_MANY, 'IrModelAccess', 'model_id'),
			'irActServers' => array(self::HAS_MANY, 'IrActServer', 'wkf_model_id'),
			'irActServers1' => array(self::HAS_MANY, 'IrActServer', 'srcmodel_id'),
			'irActServers2' => array(self::HAS_MANY, 'IrActServer', 'model_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'model' => 'Model',
			'name' => 'Name',
			'state' => 'State',
			'info' => 'Info',
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
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
		$criteria->compare('model',$this->model,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('info',$this->info,true);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);

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
	 * @return IrModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
