<?php

/**
 * This is the model class for table "ir_values".
 *
 * The followings are the available columns in table 'ir_values':
 * @property integer $id
 * @property string $name
 * @property string $key
 * @property string $key2
 * @property string $model
 * @property string $value
 * @property string $meta
 * @property integer $res_id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $model_id
 * @property integer $user_id
 * @property integer $company_id
 * @property integer $action_id
 *
 * The followings are the available model relations:
 * @property EmailTemplate[] $emailTemplates
 * @property EmailTemplatePreview[] $emailTemplatePreviews
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property IrModel $model0
 * @property ResUsers $createU
 * @property ResCompany $company
 */
class IrValues extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_values';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, key, model', 'required'),
			array('res_id, create_uid, write_uid, model_id, user_id, company_id, action_id', 'numerical', 'integerOnly'=>true),
			array('name, key, model', 'length', 'max'=>128),
			array('key2', 'length', 'max'=>256),
			array('value, meta, create_date, write_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, key, key2, model, value, meta, res_id, create_uid, create_date, write_date, write_uid, model_id, user_id, company_id, action_id', 'safe', 'on'=>'search'),
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
			'emailTemplates' => array(self::HAS_MANY, 'EmailTemplate', 'ref_ir_value'),
			'emailTemplatePreviews' => array(self::HAS_MANY, 'EmailTemplatePreview', 'ref_ir_value'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'user' => array(self::BELONGS_TO, 'ResUsers', 'user_id'),
			'model0' => array(self::BELONGS_TO, 'IrModel', 'model_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
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
			'key' => 'Key',
			'key2' => 'Key2',
			'model' => 'Model',
			'value' => 'Value',
			'meta' => 'Meta',
			'res_id' => 'Res',
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'model_id' => 'Model',
			'user_id' => 'User',
			'company_id' => 'Company',
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
		$criteria->compare('key',$this->key,true);
		$criteria->compare('key2',$this->key2,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('meta',$this->meta,true);
		$criteria->compare('res_id',$this->res_id);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('company_id',$this->company_id);
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
	 * @return IrValues the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
