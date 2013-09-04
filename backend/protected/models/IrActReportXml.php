<?php

/**
 * This is the model class for table "ir_act_report_xml".
 *
 * The followings are the available columns in table 'ir_act_report_xml':
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $usage
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $help
 * @property string $model
 * @property string $report_name
 * @property string $report_xsl
 * @property string $report_xml
 * @property boolean $auto
 * @property string $report_rml_content_data
 * @property boolean $header
 * @property string $report_type
 * @property string $report_file
 * @property boolean $multi
 * @property string $report_rml
 * @property string $attachment
 * @property string $report_sxw_content_data
 * @property boolean $attachment_use
 *
 * The followings are the available model relations:
 * @property EmailTemplate[] $emailTemplates
 * @property EmailTemplatePreview[] $emailTemplatePreviews
 * @property ResGroupsReportRel[] $resGroupsReportRels
 */
class IrActReportXml extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_act_report_xml';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, model, report_name, report_type', 'required'),
			array('create_uid, write_uid', 'numerical', 'integerOnly'=>true),
			array('name, model, report_name', 'length', 'max'=>64),
			array('type, usage, report_type', 'length', 'max'=>32),
			array('report_xsl, report_xml, report_file, report_rml', 'length', 'max'=>256),
			array('attachment', 'length', 'max'=>128),
			array('create_date, write_date, help, auto, report_rml_content_data, header, multi, report_sxw_content_data, attachment_use', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, type, usage, create_uid, create_date, write_date, write_uid, help, model, report_name, report_xsl, report_xml, auto, report_rml_content_data, header, report_type, report_file, multi, report_rml, attachment, report_sxw_content_data, attachment_use', 'safe', 'on'=>'search'),
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
			'emailTemplates' => array(self::HAS_MANY, 'EmailTemplate', 'report_template'),
			'emailTemplatePreviews' => array(self::HAS_MANY, 'EmailTemplatePreview', 'report_template'),
			'resGroupsReportRels' => array(self::HAS_MANY, 'ResGroupsReportRel', 'uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'type' => 'Type',
			'usage' => 'Usage',
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'help' => 'Help',
			'model' => 'Model',
			'report_name' => 'Report Name',
			'report_xsl' => 'Report Xsl',
			'report_xml' => 'Report Xml',
			'auto' => 'Auto',
			'report_rml_content_data' => 'Report Rml Content Data',
			'header' => 'Header',
			'report_type' => 'Report Type',
			'report_file' => 'Report File',
			'multi' => 'Multi',
			'report_rml' => 'Report Rml',
			'attachment' => 'Attachment',
			'report_sxw_content_data' => 'Report Sxw Content Data',
			'attachment_use' => 'Attachment Use',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('usage',$this->usage,true);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('help',$this->help,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('report_name',$this->report_name,true);
		$criteria->compare('report_xsl',$this->report_xsl,true);
		$criteria->compare('report_xml',$this->report_xml,true);
		$criteria->compare('auto',$this->auto);
		$criteria->compare('report_rml_content_data',$this->report_rml_content_data,true);
		$criteria->compare('header',$this->header);
		$criteria->compare('report_type',$this->report_type,true);
		$criteria->compare('report_file',$this->report_file,true);
		$criteria->compare('multi',$this->multi);
		$criteria->compare('report_rml',$this->report_rml,true);
		$criteria->compare('attachment',$this->attachment,true);
		$criteria->compare('report_sxw_content_data',$this->report_sxw_content_data,true);
		$criteria->compare('attachment_use',$this->attachment_use);

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
	 * @return IrActReportXml the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
