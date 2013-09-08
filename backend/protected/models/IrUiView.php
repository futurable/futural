<?php

/**
 * This is the model class for table "ir_ui_view".
 *
 * The followings are the available columns in table 'ir_ui_view':
 * @property integer $id
 * @property string $model
 * @property string $type
 * @property string $arch
 * @property string $field_parent
 * @property integer $priority
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $inherit_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property IrActWindowView[] $irActWindowViews
 * @property IrActWindow[] $irActWindows
 * @property IrActWindow[] $irActWindows1
 * @property ResUsers $writeU
 * @property IrUiView $inherit
 * @property IrUiView[] $irUiViews
 * @property ResUsers $createU
 * @property IrUiViewCustom[] $irUiViewCustoms
 * @property IrUiViewGroupRel[] $irUiViewGroupRels
 */
class IrUiView extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_ui_view';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('arch', 'required'),
			array('priority, create_uid, write_uid, inherit_id', 'numerical', 'integerOnly'=>true),
			array('model, type, field_parent', 'length', 'max'=>64),
			array('create_date, write_date, name', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, model, type, arch, field_parent, priority, create_uid, create_date, write_date, write_uid, inherit_id, name', 'safe', 'on'=>'search'),
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
			'irActWindowViews' => array(self::HAS_MANY, 'IrActWindowView', 'view_id'),
			'irActWindows' => array(self::HAS_MANY, 'IrActWindow', 'view_id'),
			'irActWindows1' => array(self::HAS_MANY, 'IrActWindow', 'search_view_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'inherit' => array(self::BELONGS_TO, 'IrUiView', 'inherit_id'),
			'irUiViews' => array(self::HAS_MANY, 'IrUiView', 'inherit_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'irUiViewCustoms' => array(self::HAS_MANY, 'IrUiViewCustom', 'ref_id'),
			'irUiViewGroupRels' => array(self::HAS_MANY, 'IrUiViewGroupRel', 'view_id'),
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
			'type' => 'Type',
			'arch' => 'Arch',
			'field_parent' => 'Field Parent',
			'priority' => 'Priority',
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'inherit_id' => 'Inherit',
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
		$criteria->compare('model',$this->model,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('arch',$this->arch,true);
		$criteria->compare('field_parent',$this->field_parent,true);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('inherit_id',$this->inherit_id);
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
	 * @return IrUiView the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
