<?php

/**
 * This is the model class for table "email_template_preview".
 *
 * The followings are the available columns in table 'email_template_preview':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $model_id
 * @property integer $sub_model_object_field
 * @property boolean $auto_delete
 * @property integer $mail_server_id
 * @property string $body_html
 * @property string $email_to
 * @property integer $sub_object
 * @property integer $ref_ir_act_window
 * @property string $subject
 * @property string $lang
 * @property string $name
 * @property string $email_recipients
 * @property integer $model_object_field
 * @property string $report_name
 * @property integer $report_template
 * @property integer $ref_ir_value
 * @property boolean $user_signature
 * @property string $null_value
 * @property string $reply_to
 * @property string $email_cc
 * @property string $model
 * @property string $copyvalue
 * @property string $res_id
 * @property string $email_from
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property IrModel $subObject
 * @property IrModelFields $subModelObjectField
 * @property IrActReportXml $reportTemplate
 * @property IrValues $refIrValue
 * @property IrActWindow $refIrActWindow
 * @property IrModelFields $modelObjectField
 * @property IrModel $model0
 * @property IrMailServer $mailServer
 * @property ResUsers $createU
 */
class EmailTemplatePreview extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'email_template_preview';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_uid, write_uid, model_id, sub_model_object_field, mail_server_id, sub_object, ref_ir_act_window, model_object_field, report_template, ref_ir_value', 'numerical', 'integerOnly'=>true),
			array('model', 'length', 'max'=>128),
			array('create_date, write_date, auto_delete, body_html, email_to, subject, lang, name, email_recipients, report_name, user_signature, null_value, reply_to, email_cc, copyvalue, res_id, email_from', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, model_id, sub_model_object_field, auto_delete, mail_server_id, body_html, email_to, sub_object, ref_ir_act_window, subject, lang, name, email_recipients, model_object_field, report_name, report_template, ref_ir_value, user_signature, null_value, reply_to, email_cc, model, copyvalue, res_id, email_from', 'safe', 'on'=>'search'),
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
			'subObject' => array(self::BELONGS_TO, 'IrModel', 'sub_object'),
			'subModelObjectField' => array(self::BELONGS_TO, 'IrModelFields', 'sub_model_object_field'),
			'reportTemplate' => array(self::BELONGS_TO, 'IrActReportXml', 'report_template'),
			'refIrValue' => array(self::BELONGS_TO, 'IrValues', 'ref_ir_value'),
			'refIrActWindow' => array(self::BELONGS_TO, 'IrActWindow', 'ref_ir_act_window'),
			'modelObjectField' => array(self::BELONGS_TO, 'IrModelFields', 'model_object_field'),
			'model0' => array(self::BELONGS_TO, 'IrModel', 'model_id'),
			'mailServer' => array(self::BELONGS_TO, 'IrMailServer', 'mail_server_id'),
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
			'model_id' => 'Model',
			'sub_model_object_field' => 'Sub Model Object Field',
			'auto_delete' => 'Auto Delete',
			'mail_server_id' => 'Mail Server',
			'body_html' => 'Body Html',
			'email_to' => 'Email To',
			'sub_object' => 'Sub Object',
			'ref_ir_act_window' => 'Ref Ir Act Window',
			'subject' => 'Subject',
			'lang' => 'Lang',
			'name' => 'Name',
			'email_recipients' => 'Email Recipients',
			'model_object_field' => 'Model Object Field',
			'report_name' => 'Report Name',
			'report_template' => 'Report Template',
			'ref_ir_value' => 'Ref Ir Value',
			'user_signature' => 'User Signature',
			'null_value' => 'Null Value',
			'reply_to' => 'Reply To',
			'email_cc' => 'Email Cc',
			'model' => 'Model',
			'copyvalue' => 'Copyvalue',
			'res_id' => 'Res',
			'email_from' => 'Email From',
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
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('sub_model_object_field',$this->sub_model_object_field);
		$criteria->compare('auto_delete',$this->auto_delete);
		$criteria->compare('mail_server_id',$this->mail_server_id);
		$criteria->compare('body_html',$this->body_html,true);
		$criteria->compare('email_to',$this->email_to,true);
		$criteria->compare('sub_object',$this->sub_object);
		$criteria->compare('ref_ir_act_window',$this->ref_ir_act_window);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('lang',$this->lang,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email_recipients',$this->email_recipients,true);
		$criteria->compare('model_object_field',$this->model_object_field);
		$criteria->compare('report_name',$this->report_name,true);
		$criteria->compare('report_template',$this->report_template);
		$criteria->compare('ref_ir_value',$this->ref_ir_value);
		$criteria->compare('user_signature',$this->user_signature);
		$criteria->compare('null_value',$this->null_value,true);
		$criteria->compare('reply_to',$this->reply_to,true);
		$criteria->compare('email_cc',$this->email_cc,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('copyvalue',$this->copyvalue,true);
		$criteria->compare('res_id',$this->res_id,true);
		$criteria->compare('email_from',$this->email_from,true);

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
	 * @return EmailTemplatePreview the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
