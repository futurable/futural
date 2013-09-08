<?php

/**
 * This is the model class for table "mail_alias".
 *
 * The followings are the available columns in table 'mail_alias':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $alias_model_id
 * @property string $alias_defaults
 * @property integer $alias_force_thread_id
 * @property string $alias_name
 * @property integer $alias_user_id
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property ResUsers $aliasUser
 * @property IrModel $aliasModel
 * @property ProjectProject[] $projectProjects
 * @property CrmCaseSection[] $crmCaseSections
 * @property ResUsers[] $resUsers
 * @property MailGroup[] $mailGroups
 */
class MailAlias extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mail_alias';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('alias_model_id, alias_defaults, alias_name', 'required'),
			array('create_uid, write_uid, alias_model_id, alias_force_thread_id, alias_user_id', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, alias_model_id, alias_defaults, alias_force_thread_id, alias_name, alias_user_id', 'safe', 'on'=>'search'),
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
			'aliasUser' => array(self::BELONGS_TO, 'ResUsers', 'alias_user_id'),
			'aliasModel' => array(self::BELONGS_TO, 'IrModel', 'alias_model_id'),
			'projectProjects' => array(self::HAS_MANY, 'ProjectProject', 'alias_id'),
			'crmCaseSections' => array(self::HAS_MANY, 'CrmCaseSection', 'alias_id'),
			'resUsers' => array(self::HAS_MANY, 'ResUsers', 'alias_id'),
			'mailGroups' => array(self::HAS_MANY, 'MailGroup', 'alias_id'),
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
			'alias_model_id' => 'Alias Model',
			'alias_defaults' => 'Alias Defaults',
			'alias_force_thread_id' => 'Alias Force Thread',
			'alias_name' => 'Alias Name',
			'alias_user_id' => 'Alias User',
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
		$criteria->compare('alias_model_id',$this->alias_model_id);
		$criteria->compare('alias_defaults',$this->alias_defaults,true);
		$criteria->compare('alias_force_thread_id',$this->alias_force_thread_id);
		$criteria->compare('alias_name',$this->alias_name,true);
		$criteria->compare('alias_user_id',$this->alias_user_id);

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
	 * @return MailAlias the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
