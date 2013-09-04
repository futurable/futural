<?php

/**
 * This is the model class for table "ir_mail_server".
 *
 * The followings are the available columns in table 'ir_mail_server':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $name
 * @property integer $sequence
 * @property integer $smtp_port
 * @property string $smtp_host
 * @property string $smtp_user
 * @property string $smtp_pass
 * @property boolean $smtp_debug
 * @property boolean $active
 * @property string $smtp_encryption
 *
 * The followings are the available model relations:
 * @property EmailTemplate[] $emailTemplates
 * @property EmailTemplatePreview[] $emailTemplatePreviews
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property MailMail[] $mailMails
 */
class IrMailServer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_mail_server';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, smtp_port, smtp_host, smtp_encryption', 'required'),
			array('create_uid, write_uid, sequence, smtp_port', 'numerical', 'integerOnly'=>true),
			array('name, smtp_user, smtp_pass', 'length', 'max'=>64),
			array('smtp_host', 'length', 'max'=>128),
			array('create_date, write_date, smtp_debug, active', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, name, sequence, smtp_port, smtp_host, smtp_user, smtp_pass, smtp_debug, active, smtp_encryption', 'safe', 'on'=>'search'),
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
			'emailTemplates' => array(self::HAS_MANY, 'EmailTemplate', 'mail_server_id'),
			'emailTemplatePreviews' => array(self::HAS_MANY, 'EmailTemplatePreview', 'mail_server_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'mailMails' => array(self::HAS_MANY, 'MailMail', 'mail_server_id'),
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
			'smtp_port' => 'Smtp Port',
			'smtp_host' => 'Smtp Host',
			'smtp_user' => 'Smtp User',
			'smtp_pass' => 'Smtp Pass',
			'smtp_debug' => 'Smtp Debug',
			'active' => 'Active',
			'smtp_encryption' => 'Smtp Encryption',
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
		$criteria->compare('smtp_port',$this->smtp_port);
		$criteria->compare('smtp_host',$this->smtp_host,true);
		$criteria->compare('smtp_user',$this->smtp_user,true);
		$criteria->compare('smtp_pass',$this->smtp_pass,true);
		$criteria->compare('smtp_debug',$this->smtp_debug);
		$criteria->compare('active',$this->active);
		$criteria->compare('smtp_encryption',$this->smtp_encryption,true);

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
	 * @return IrMailServer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
