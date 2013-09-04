<?php

/**
 * This is the model class for table "ir_attachment".
 *
 * The followings are the available columns in table 'ir_attachment':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $description
 * @property string $datas_fname
 * @property string $url
 * @property string $res_model
 * @property integer $company_id
 * @property string $res_name
 * @property string $type
 * @property integer $res_id
 * @property integer $file_size
 * @property string $db_datas
 * @property string $store_fname
 * @property string $name
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property MailComposeMessageIrAttachmentsRel[] $mailComposeMessageIrAttachmentsRels
 * @property MessageAttachmentRel[] $messageAttachmentRels
 * @property EmailTemplateAttachmentRel[] $emailTemplateAttachmentRels
 */
class IrAttachment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_attachment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, name', 'required'),
			array('create_uid, write_uid, company_id, res_id, file_size', 'numerical', 'integerOnly'=>true),
			array('datas_fname, store_fname, name', 'length', 'max'=>256),
			array('url', 'length', 'max'=>1024),
			array('res_model', 'length', 'max'=>64),
			array('res_name', 'length', 'max'=>128),
			array('create_date, write_date, description, db_datas', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, description, datas_fname, url, res_model, company_id, res_name, type, res_id, file_size, db_datas, store_fname, name', 'safe', 'on'=>'search'),
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
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'mailComposeMessageIrAttachmentsRels' => array(self::HAS_MANY, 'MailComposeMessageIrAttachmentsRel', 'attachment_id'),
			'messageAttachmentRels' => array(self::HAS_MANY, 'MessageAttachmentRel', 'attachment_id'),
			'emailTemplateAttachmentRels' => array(self::HAS_MANY, 'EmailTemplateAttachmentRel', 'attachment_id'),
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
			'description' => 'Description',
			'datas_fname' => 'Datas Fname',
			'url' => 'Url',
			'res_model' => 'Res Model',
			'company_id' => 'Company',
			'res_name' => 'Res Name',
			'type' => 'Type',
			'res_id' => 'Res',
			'file_size' => 'File Size',
			'db_datas' => 'Db Datas',
			'store_fname' => 'Store Fname',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('datas_fname',$this->datas_fname,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('res_model',$this->res_model,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('res_name',$this->res_name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('res_id',$this->res_id);
		$criteria->compare('file_size',$this->file_size);
		$criteria->compare('db_datas',$this->db_datas,true);
		$criteria->compare('store_fname',$this->store_fname,true);
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
	 * @return IrAttachment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
