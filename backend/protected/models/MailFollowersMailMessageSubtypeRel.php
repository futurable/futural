<?php

/**
 * This is the model class for table "mail_followers_mail_message_subtype_rel".
 *
 * The followings are the available columns in table 'mail_followers_mail_message_subtype_rel':
 * @property integer $mail_followers_id
 * @property integer $mail_message_subtype_id
 *
 * The followings are the available model relations:
 * @property MailFollowers $mailFollowers
 * @property MailMessageSubtype $mailMessageSubtype
 */
class MailFollowersMailMessageSubtypeRel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mail_followers_mail_message_subtype_rel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mail_followers_id, mail_message_subtype_id', 'required'),
			array('mail_followers_id, mail_message_subtype_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('mail_followers_id, mail_message_subtype_id', 'safe', 'on'=>'search'),
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
			'mailFollowers' => array(self::BELONGS_TO, 'MailFollowers', 'mail_followers_id'),
			'mailMessageSubtype' => array(self::BELONGS_TO, 'MailMessageSubtype', 'mail_message_subtype_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mail_followers_id' => 'Mail Followers',
			'mail_message_subtype_id' => 'Mail Message Subtype',
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

		$criteria->compare('mail_followers_id',$this->mail_followers_id);
		$criteria->compare('mail_message_subtype_id',$this->mail_message_subtype_id);

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
	 * @return MailFollowersMailMessageSubtypeRel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
