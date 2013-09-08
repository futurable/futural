<?php

/**
 * This is the model class for table "ir_model_fields".
 *
 * The followings are the available columns in table 'ir_model_fields':
 * @property integer $id
 * @property string $model
 * @property integer $model_id
 * @property string $name
 * @property string $relation
 * @property string $select_level
 * @property string $field_description
 * @property string $ttype
 * @property string $state
 * @property boolean $view_load
 * @property boolean $relate
 * @property string $relation_field
 * @property boolean $translate
 * @property integer $serialization_field_id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $domain
 * @property string $selection
 * @property string $on_delete
 * @property boolean $selectable
 * @property integer $size
 * @property boolean $required
 * @property boolean $readonly
 * @property string $complete_name
 *
 * The followings are the available model relations:
 * @property BaseActionRule[] $baseActionRules
 * @property EmailTemplate[] $emailTemplates
 * @property EmailTemplate[] $emailTemplates1
 * @property EmailTemplatePreview[] $emailTemplatePreviews
 * @property EmailTemplatePreview[] $emailTemplatePreviews1
 * @property IrModelFieldsGroupRel[] $irModelFieldsGroupRels
 * @property ResUsers $writeU
 * @property IrModelFields $serializationField
 * @property IrModelFields[] $irModelFields
 * @property IrModel $model0
 * @property ResUsers $createU
 * @property IrProperty[] $irProperties
 * @property IrServerObjectLines[] $irServerObjectLines
 * @property MultiCompanyDefault[] $multiCompanyDefaults
 * @property IrActServer[] $irActServers
 * @property IrActServer[] $irActServers1
 */
class IrModelFields extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_model_fields';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('model_id, select_level, field_description, ttype', 'required'),
			array('model_id, serialization_field_id, create_uid, write_uid, size', 'numerical', 'integerOnly'=>true),
			array('model, name, relation, ttype, state, complete_name', 'length', 'max'=>64),
			array('select_level', 'length', 'max'=>4),
			array('field_description, domain', 'length', 'max'=>256),
			array('relation_field, selection', 'length', 'max'=>128),
			array('view_load, relate, translate, create_date, write_date, on_delete, selectable, required, readonly', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, model, model_id, name, relation, select_level, field_description, ttype, state, view_load, relate, relation_field, translate, serialization_field_id, create_uid, create_date, write_date, write_uid, domain, selection, on_delete, selectable, size, required, readonly, complete_name', 'safe', 'on'=>'search'),
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
			'baseActionRules' => array(self::HAS_MANY, 'BaseActionRule', 'trg_date_id'),
			'emailTemplates' => array(self::HAS_MANY, 'EmailTemplate', 'sub_model_object_field'),
			'emailTemplates1' => array(self::HAS_MANY, 'EmailTemplate', 'model_object_field'),
			'emailTemplatePreviews' => array(self::HAS_MANY, 'EmailTemplatePreview', 'sub_model_object_field'),
			'emailTemplatePreviews1' => array(self::HAS_MANY, 'EmailTemplatePreview', 'model_object_field'),
			'irModelFieldsGroupRels' => array(self::HAS_MANY, 'IrModelFieldsGroupRel', 'field_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'serializationField' => array(self::BELONGS_TO, 'IrModelFields', 'serialization_field_id'),
			'irModelFields' => array(self::HAS_MANY, 'IrModelFields', 'serialization_field_id'),
			'model0' => array(self::BELONGS_TO, 'IrModel', 'model_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'irProperties' => array(self::HAS_MANY, 'IrProperty', 'fields_id'),
			'irServerObjectLines' => array(self::HAS_MANY, 'IrServerObjectLines', 'col1'),
			'multiCompanyDefaults' => array(self::HAS_MANY, 'MultiCompanyDefault', 'field_id'),
			'irActServers' => array(self::HAS_MANY, 'IrActServer', 'trigger_obj_id'),
			'irActServers1' => array(self::HAS_MANY, 'IrActServer', 'record_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'model' => 'Model',
			'model_id' => 'Model',
			'name' => 'Name',
			'relation' => 'Relation',
			'select_level' => 'Select Level',
			'field_description' => 'Field Description',
			'ttype' => 'Ttype',
			'state' => 'State',
			'view_load' => 'View Load',
			'relate' => 'Relate',
			'relation_field' => 'Relation Field',
			'translate' => 'Translate',
			'serialization_field_id' => 'Serialization Field',
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'domain' => 'Domain',
			'selection' => 'Selection',
			'on_delete' => 'On Delete',
			'selectable' => 'Selectable',
			'size' => 'Size',
			'required' => 'Required',
			'readonly' => 'Readonly',
			'complete_name' => 'Complete Name',
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
		$criteria->compare('model',$this->model,true);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('relation',$this->relation,true);
		$criteria->compare('select_level',$this->select_level,true);
		$criteria->compare('field_description',$this->field_description,true);
		$criteria->compare('ttype',$this->ttype,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('view_load',$this->view_load);
		$criteria->compare('relate',$this->relate);
		$criteria->compare('relation_field',$this->relation_field,true);
		$criteria->compare('translate',$this->translate);
		$criteria->compare('serialization_field_id',$this->serialization_field_id);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('domain',$this->domain,true);
		$criteria->compare('selection',$this->selection,true);
		$criteria->compare('on_delete',$this->on_delete,true);
		$criteria->compare('selectable',$this->selectable);
		$criteria->compare('size',$this->size);
		$criteria->compare('required',$this->required);
		$criteria->compare('readonly',$this->readonly);
		$criteria->compare('complete_name',$this->complete_name,true);

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
	 * @return IrModelFields the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
