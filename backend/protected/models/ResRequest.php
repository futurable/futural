<?php

/**
 * This is the model class for table "res_request".
 *
 * The followings are the available columns in table 'res_request':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $body
 * @property string $name
 * @property string $date_sent
 * @property string $ref_doc2
 * @property string $priority
 * @property string $ref_doc1
 * @property string $state
 * @property integer $act_from
 * @property integer $ref_partner_id
 * @property boolean $active
 * @property string $trigger_date
 * @property integer $act_to
 *
 * The followings are the available model relations:
 * @property ResRequestHistory[] $resRequestHistories
 * @property ResUsers $writeU
 * @property ResPartner $refPartner
 * @property ResUsers $createU
 * @property ResUsers $actTo
 * @property ResUsers $actFrom
 */
class ResRequest extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'res_request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, priority, state, act_from, act_to', 'required'),
			array('create_uid, write_uid, act_from, ref_partner_id, act_to', 'numerical', 'integerOnly'=>true),
			array('name, ref_doc2, ref_doc1', 'length', 'max'=>128),
			array('create_date, write_date, body, date_sent, active, trigger_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, body, name, date_sent, ref_doc2, priority, ref_doc1, state, act_from, ref_partner_id, active, trigger_date, act_to', 'safe', 'on'=>'search'),
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
			'resRequestHistories' => array(self::HAS_MANY, 'ResRequestHistory', 'req_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'refPartner' => array(self::BELONGS_TO, 'ResPartner', 'ref_partner_id'),
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
			'name' => 'Name',
			'date_sent' => 'Date Sent',
			'ref_doc2' => 'Ref Doc2',
			'priority' => 'Priority',
			'ref_doc1' => 'Ref Doc1',
			'state' => 'State',
			'act_from' => 'Act From',
			'ref_partner_id' => 'Ref Partner',
			'active' => 'Active',
			'trigger_date' => 'Trigger Date',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('date_sent',$this->date_sent,true);
		$criteria->compare('ref_doc2',$this->ref_doc2,true);
		$criteria->compare('priority',$this->priority,true);
		$criteria->compare('ref_doc1',$this->ref_doc1,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('act_from',$this->act_from);
		$criteria->compare('ref_partner_id',$this->ref_partner_id);
		$criteria->compare('active',$this->active);
		$criteria->compare('trigger_date',$this->trigger_date,true);
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
	 * @return ResRequest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
