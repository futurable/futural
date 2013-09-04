<?php

/**
 * This is the model class for table "ir_sequence".
 *
 * The followings are the available columns in table 'ir_sequence':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $code
 * @property string $suffix
 * @property integer $number_next
 * @property integer $number_increment
 * @property string $implementation
 * @property integer $company_id
 * @property integer $padding
 * @property boolean $active
 * @property string $prefix
 * @property string $name
 *
 * The followings are the available model relations:
 * @property AccountSequenceFiscalyear[] $accountSequenceFiscalyears
 * @property AccountSequenceFiscalyear[] $accountSequenceFiscalyears1
 * @property AccountJournal[] $accountJournals
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property ResCompany $company
 */
class IrSequence extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_sequence';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number_next, number_increment, implementation, padding, name', 'required'),
			array('create_uid, write_uid, number_next, number_increment, company_id, padding', 'numerical', 'integerOnly'=>true),
			array('code, suffix, prefix, name', 'length', 'max'=>64),
			array('create_date, write_date, active', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, code, suffix, number_next, number_increment, implementation, company_id, padding, active, prefix, name', 'safe', 'on'=>'search'),
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
			'accountSequenceFiscalyears' => array(self::HAS_MANY, 'AccountSequenceFiscalyear', 'sequence_main_id'),
			'accountSequenceFiscalyears1' => array(self::HAS_MANY, 'AccountSequenceFiscalyear', 'sequence_id'),
			'accountJournals' => array(self::HAS_MANY, 'AccountJournal', 'sequence_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
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
			'code' => 'Code',
			'suffix' => 'Suffix',
			'number_next' => 'Number Next',
			'number_increment' => 'Number Increment',
			'implementation' => 'Implementation',
			'company_id' => 'Company',
			'padding' => 'Padding',
			'active' => 'Active',
			'prefix' => 'Prefix',
			'name' => 'Name',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('suffix',$this->suffix,true);
		$criteria->compare('number_next',$this->number_next);
		$criteria->compare('number_increment',$this->number_increment);
		$criteria->compare('implementation',$this->implementation,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('padding',$this->padding);
		$criteria->compare('active',$this->active);
		$criteria->compare('prefix',$this->prefix,true);
		$criteria->compare('name',$this->name,true);

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
	 * @return IrSequence the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
