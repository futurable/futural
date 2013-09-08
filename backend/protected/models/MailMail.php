<?php

/**
 * This is the model class for table "mail_mail".
 *
 * The followings are the available columns in table 'mail_mail':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $mail_message_id
 * @property boolean $notification
 * @property boolean $auto_delete
 * @property string $body_html
 * @property integer $mail_server_id
 * @property string $state
 * @property string $references
 * @property string $email_cc
 * @property string $reply_to
 * @property string $email_to
 * @property string $email_from
 * @property integer $fetchmail_server_id
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property IrMailServer $mailServer
 * @property MailMessage $mailMessage
 * @property FetchmailServer $fetchmailServer
 * @property ResUsers $createU
 */
class MailMail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mail_mail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mail_message_id', 'required'),
			array('create_uid, write_uid, mail_message_id, mail_server_id, fetchmail_server_id', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date, notification, auto_delete, body_html, state, references, email_cc, reply_to, email_to, email_from', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, mail_message_id, notification, auto_delete, body_html, mail_server_id, state, references, email_cc, reply_to, email_to, email_from, fetchmail_server_id', 'safe', 'on'=>'search'),
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
			'mailServer' => array(self::BELONGS_TO, 'IrMailServer', 'mail_server_id'),
			'mailMessage' => array(self::BELONGS_TO, 'MailMessage', 'mail_message_id'),
			'fetchmailServer' => array(self::BELONGS_TO, 'FetchmailServer', 'fetchmail_server_id'),
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
			'mail_message_id' => 'Mail Message',
			'notification' => 'Notification',
			'auto_delete' => 'Auto Delete',
			'body_html' => 'Body Html',
			'mail_server_id' => 'Mail Server',
			'state' => 'State',
			'references' => 'References',
			'email_cc' => 'Email Cc',
			'reply_to' => 'Reply To',
			'email_to' => 'Email To',
			'email_from' => 'Email From',
			'fetchmail_server_id' => 'Fetchmail Server',
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
		$criteria->compare('mail_message_id',$this->mail_message_id);
		$criteria->compare('notification',$this->notification);
		$criteria->compare('auto_delete',$this->auto_delete);
		$criteria->compare('body_html',$this->body_html,true);
		$criteria->compare('mail_server_id',$this->mail_server_id);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('references',$this->references,true);
		$criteria->compare('email_cc',$this->email_cc,true);
		$criteria->compare('reply_to',$this->reply_to,true);
		$criteria->compare('email_to',$this->email_to,true);
		$criteria->compare('email_from',$this->email_from,true);
		$criteria->compare('fetchmail_server_id',$this->fetchmail_server_id);

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
	 * @return MailMail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
