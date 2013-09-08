<?php

/**
 * This is the model class for table "crm_opportunity2phonecall".
 *
 * The followings are the available columns in table 'crm_opportunity2phonecall':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $user_id
 * @property string $name
 * @property integer $categ_id
 * @property integer $section_id
 * @property string $note
 * @property string $phone
 * @property string $date
 * @property string $contact_name
 * @property integer $partner_id
 * @property string $action
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ResUsers $user
 * @property CrmCaseSection $section
 * @property ResPartner $partner
 * @property ResUsers $createU
 * @property CrmCaseCateg $categ
 */
class CrmOpportunity2phonecall extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'crm_opportunity2phonecall';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, action', 'required'),
			array('create_uid, write_uid, user_id, categ_id, section_id, partner_id', 'numerical', 'integerOnly'=>true),
			array('name, phone, contact_name', 'length', 'max'=>64),
			array('create_date, write_date, note, date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, user_id, name, categ_id, section_id, note, phone, date, contact_name, partner_id, action', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'ResUsers', 'user_id'),
			'section' => array(self::BELONGS_TO, 'CrmCaseSection', 'section_id'),
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'categ' => array(self::BELONGS_TO, 'CrmCaseCateg', 'categ_id'),
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
			'user_id' => 'User',
			'name' => 'Name',
			'categ_id' => 'Categ',
			'section_id' => 'Section',
			'note' => 'Note',
			'phone' => 'Phone',
			'date' => 'Date',
			'contact_name' => 'Contact Name',
			'partner_id' => 'Partner',
			'action' => 'Action',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('categ_id',$this->categ_id);
		$criteria->compare('section_id',$this->section_id);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('contact_name',$this->contact_name,true);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('action',$this->action,true);

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
	 * @return CrmOpportunity2phonecall the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
