<?php

/**
 * This is the model class for table "res_request_history".
 *
 * The followings are the available columns in table 'res_request_history':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $body
 * @property integer $act_from
 * @property string $name
 * @property integer $req_id
 * @property string $date_sent
 * @property integer $act_to
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ResRequest $req
 * @property ResUsers $createU
 * @property ResUsers $actTo
 * @property ResUsers $actFrom
 */
class ResRequestHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'res_request_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('act_from, name, req_id, date_sent, act_to', 'required'),
			array('create_uid, write_uid, act_from, req_id, act_to', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			array('create_date, write_date, body', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, body, act_from, name, req_id, date_sent, act_to', 'safe', 'on'=>'search'),
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
			'req' => array(self::BELONGS_TO, 'ResRequest', 'req_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'actTo' => array(self::BELONGS_TO, 'ResUsers', 'act_to'),
			'actFrom' => array(self::BELONGS_TO, 'ResUsers', 'act_from'),
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
			'body' => 'Body',
			'act_from' => 'Act From',
			'name' => 'Name',
			'req_id' => 'Req',
			'date_sent' => 'Date Sent',
			'act_to' => 'Act To',
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
		$criteria->compare('body',$this->body,true);
		$criteria->compare('act_from',$this->act_from);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('req_id',$this->req_id);
		$criteria->compare('date_sent',$this->date_sent,true);
		$criteria->compare('act_to',$this->act_to);

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
	 * @return ResRequestHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
