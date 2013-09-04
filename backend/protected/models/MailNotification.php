<?php

/**
 * This is the model class for table "mail_notification".
 *
 * The followings are the available columns in table 'mail_notification':
 * @property integer $id
 * @property boolean $read
 * @property boolean $starred
 * @property integer $partner_id
 * @property integer $message_id
 *
 * The followings are the available model relations:
 * @property ResPartner $partner
 * @property MailMessage $message
 */
class MailNotification extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mail_notification';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('partner_id, message_id', 'required'),
			array('partner_id, message_id', 'numerical', 'integerOnly'=>true),
			array('read, starred', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, read, starred, partner_id, message_id', 'safe', 'on'=>'search'),
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
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'message' => array(self::BELONGS_TO, 'MailMessage', 'message_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'read' => 'Read',
			'starred' => 'Starred',
			'partner_id' => 'Partner',
			'message_id' => 'Message',
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
		$criteria->compare('read',$this->read);
		$criteria->compare('starred',$this->starred);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('message_id',$this->message_id);

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
	 * @return MailNotification the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
