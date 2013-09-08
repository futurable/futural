<?php

/**
 * This is the model class for table "multi_company_default".
 *
 * The followings are the available columns in table 'multi_company_default':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $name
 * @property integer $sequence
 * @property string $expression
 * @property integer $company_dest_id
 * @property integer $field_id
 * @property integer $company_id
 * @property integer $object_id
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property IrModel $object
 * @property IrModelFields $field
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property ResCompany $companyDest
 */
class MultiCompanyDefault extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'multi_company_default';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, expression, company_dest_id, company_id, object_id', 'required'),
			array('create_uid, write_uid, sequence, company_dest_id, field_id, company_id, object_id', 'numerical', 'integerOnly'=>true),
			array('name, expression', 'length', 'max'=>256),
			array('create_date, write_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, name, sequence, expression, company_dest_id, field_id, company_id, object_id', 'safe', 'on'=>'search'),
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
			'object' => array(self::BELONGS_TO, 'IrModel', 'object_id'),
			'field' => array(self::BELONGS_TO, 'IrModelFields', 'field_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'companyDest' => array(self::BELONGS_TO, 'ResCompany', 'company_dest_id'),
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
			'name' => 'Name',
			'sequence' => 'Sequence',
			'expression' => 'Expression',
			'company_dest_id' => 'Company Dest',
			'field_id' => 'Field',
			'company_id' => 'Company',
			'object_id' => 'Object',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('expression',$this->expression,true);
		$criteria->compare('company_dest_id',$this->company_dest_id);
		$criteria->compare('field_id',$this->field_id);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('object_id',$this->object_id);

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
	 * @return MultiCompanyDefault the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
