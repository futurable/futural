<?php

/**
 * This is the model class for table "ir_filters".
 *
 * The followings are the available columns in table 'ir_filters':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property boolean $is_default
 * @property string $model_id
 * @property string $domain
 * @property integer $user_id
 * @property string $name
 * @property string $context
 *
 * The followings are the available model relations:
 * @property BaseActionRule[] $baseActionRules
 * @property BaseActionRule[] $baseActionRules1
 * @property MailComposeMessage[] $mailComposeMessages
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property ResUsers $createU
 */
class IrFilters extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_filters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('model_id, domain, name, context', 'required'),
			array('create_uid, write_uid, user_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, is_default', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, is_default, model_id, domain, user_id, name, context', 'safe', 'on'=>'search'),
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
			'baseActionRules' => array(self::HAS_MANY, 'BaseActionRule', 'filter_pre_id'),
			'baseActionRules1' => array(self::HAS_MANY, 'BaseActionRule', 'filter_id'),
			'mailComposeMessages' => array(self::HAS_MANY, 'MailComposeMessage', 'filter_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'user' => array(self::BELONGS_TO, 'ResUsers', 'user_id'),
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
			'is_default' => 'Is Default',
			'model_id' => 'Model',
			'domain' => 'Domain',
			'user_id' => 'User',
			'name' => 'Name',
			'context' => 'Context',
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
		$criteria->compare('is_default',$this->is_default);
		$criteria->compare('model_id',$this->model_id,true);
		$criteria->compare('domain',$this->domain,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('context',$this->context,true);

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
	 * @return IrFilters the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
