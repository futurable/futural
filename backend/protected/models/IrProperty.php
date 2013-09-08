<?php

/**
 * This is the model class for table "ir_property".
 *
 * The followings are the available columns in table 'ir_property':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $value_text
 * @property double $value_float
 * @property string $name
 * @property integer $value_integer
 * @property string $type
 * @property integer $company_id
 * @property integer $fields_id
 * @property string $value_datetime
 * @property string $value_binary
 * @property string $value_reference
 * @property string $res_id
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property IrModelFields $fields
 * @property ResUsers $createU
 * @property ResCompany $company
 */
class IrProperty extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_property';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, fields_id', 'required'),
			array('create_uid, write_uid, value_integer, company_id, fields_id', 'numerical', 'integerOnly'=>true),
			array('value_float', 'numerical'),
			array('name, value_reference, res_id', 'length', 'max'=>128),
			array('create_date, write_date, value_text, value_datetime, value_binary', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, value_text, value_float, name, value_integer, type, company_id, fields_id, value_datetime, value_binary, value_reference, res_id', 'safe', 'on'=>'search'),
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
			'fields' => array(self::BELONGS_TO, 'IrModelFields', 'fields_id'),
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
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'value_text' => 'Value Text',
			'value_float' => 'Value Float',
			'name' => 'Name',
			'value_integer' => 'Value Integer',
			'type' => 'Type',
			'company_id' => 'Company',
			'fields_id' => 'Fields',
			'value_datetime' => 'Value Datetime',
			'value_binary' => 'Value Binary',
			'value_reference' => 'Value Reference',
			'res_id' => 'Res',
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
		$criteria->compare('value_text',$this->value_text,true);
		$criteria->compare('value_float',$this->value_float);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('value_integer',$this->value_integer);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('fields_id',$this->fields_id);
		$criteria->compare('value_datetime',$this->value_datetime,true);
		$criteria->compare('value_binary',$this->value_binary,true);
		$criteria->compare('value_reference',$this->value_reference,true);
		$criteria->compare('res_id',$this->res_id,true);

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
	 * @return IrProperty the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
