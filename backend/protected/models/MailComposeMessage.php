<?php

/**
 * This is the model class for table "mail_compose_message".
 *
 * The followings are the available columns in table 'mail_compose_message':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $body
 * @property string $model
 * @property string $record_name
 * @property string $date
 * @property string $subject
 * @property string $composition_mode
 * @property string $message_id
 * @property integer $parent_id
 * @property integer $res_id
 * @property integer $subtype_id
 * @property integer $filter_id
 * @property integer $author_id
 * @property string $type
 * @property string $email_from
 * @property integer $template_id
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property MailMessageSubtype $subtype
 * @property MailMessage $parent
 * @property IrFilters $filter
 * @property ResUsers $createU
 * @property ResPartner $author
 * @property MailComposeMessageIrAttachmentsRel[] $mailComposeMessageIrAttachmentsRels
 * @property MailComposeMessageResPartnerRel[] $mailComposeMessageResPartnerRels
 */
class MailComposeMessage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mail_compose_message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_uid, write_uid, parent_id, res_id, subtype_id, filter_id, author_id, template_id', 'numerical', 'integerOnly'=>true),
			array('model', 'length', 'max'=>128),
			array('create_date, write_date, body, record_name, date, subject, composition_mode, message_id, type, email_from', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, body, model, record_name, date, subject, composition_mode, message_id, parent_id, res_id, subtype_id, filter_id, author_id, type, email_from, template_id', 'safe', 'on'=>'search'),
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
			'subtype' => array(self::BELONGS_TO, 'MailMessageSubtype', 'subtype_id'),
			'parent' => array(self::BELONGS_TO, 'MailMessage', 'parent_id'),
			'filter' => array(self::BELONGS_TO, 'IrFilters', 'filter_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'author' => array(self::BELONGS_TO, 'ResPartner', 'author_id'),
			'mailComposeMessageIrAttachmentsRels' => array(self::HAS_MANY, 'MailComposeMessageIrAttachmentsRel', 'wizard_id'),
			'mailComposeMessageResPartnerRels' => array(self::HAS_MANY, 'MailComposeMessageResPartnerRel', 'wizard_id'),
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
			'model' => 'Model',
			'record_name' => 'Record Name',
			'date' => 'Date',
			'subject' => 'Subject',
			'composition_mode' => 'Composition Mode',
			'message_id' => 'Message',
			'parent_id' => 'Parent',
			'res_id' => 'Res',
			'subtype_id' => 'Subtype',
			'filter_id' => 'Filter',
			'author_id' => 'Author',
			'type' => 'Type',
			'email_from' => 'Email From',
			'template_id' => 'Template',
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
		$criteria->compare('model',$this->model,true);
		$criteria->compare('record_name',$this->record_name,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('composition_mode',$this->composition_mode,true);
		$criteria->compare('message_id',$this->message_id,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('res_id',$this->res_id);
		$criteria->compare('subtype_id',$this->subtype_id);
		$criteria->compare('filter_id',$this->filter_id);
		$criteria->compare('author_id',$this->author_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('email_from',$this->email_from,true);
		$criteria->compare('template_id',$this->template_id);

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
	 * @return MailComposeMessage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
