<?php

/**
 * This is the model class for table "ir_act_window".
 *
 * The followings are the available columns in table 'ir_act_window':
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $usage
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $help
 * @property integer $view_id
 * @property string $res_model
 * @property string $view_type
 * @property string $domain
 * @property integer $search_view_id
 * @property integer $auto_refresh
 * @property string $view_mode
 * @property boolean $multi
 * @property string $context
 * @property string $target
 * @property boolean $auto_search
 * @property boolean $filter
 * @property string $src_model
 * @property integer $limit
 * @property integer $res_id
 *
 * The followings are the available model relations:
 * @property EmailTemplate[] $emailTemplates
 * @property EmailTemplatePreview[] $emailTemplatePreviews
 * @property IrActWindowView[] $irActWindowViews
 * @property IrUiView $view
 * @property IrUiView $searchView
 * @property ShareWizard[] $shareWizards
 * @property IrActWindowGroupRel[] $irActWindowGroupRels
 */
class IrActWindow extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_act_window';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, res_model, view_type, view_mode, context', 'required'),
			array('create_uid, write_uid, view_id, search_view_id, auto_refresh, limit, res_id', 'numerical', 'integerOnly'=>true),
			array('name, res_model, src_model', 'length', 'max'=>64),
			array('type, usage', 'length', 'max'=>32),
			array('view_type', 'length', 'max'=>16),
			array('domain, view_mode, context', 'length', 'max'=>250),
			array('create_date, write_date, help, multi, target, auto_search, filter', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, type, usage, create_uid, create_date, write_date, write_uid, help, view_id, res_model, view_type, domain, search_view_id, auto_refresh, view_mode, multi, context, target, auto_search, filter, src_model, limit, res_id', 'safe', 'on'=>'search'),
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
			'emailTemplates' => array(self::HAS_MANY, 'EmailTemplate', 'ref_ir_act_window'),
			'emailTemplatePreviews' => array(self::HAS_MANY, 'EmailTemplatePreview', 'ref_ir_act_window'),
			'irActWindowViews' => array(self::HAS_MANY, 'IrActWindowView', 'act_window_id'),
			'view' => array(self::BELONGS_TO, 'IrUiView', 'view_id'),
			'searchView' => array(self::BELONGS_TO, 'IrUiView', 'search_view_id'),
			'shareWizards' => array(self::HAS_MANY, 'ShareWizard', 'action_id'),
			'irActWindowGroupRels' => array(self::HAS_MANY, 'IrActWindowGroupRel', 'act_id'),
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
			'view_id' => 'View',
			'res_model' => 'Res Model',
			'view_type' => 'View Type',
			'domain' => 'Domain',
			'search_view_id' => 'Search View',
			'auto_refresh' => 'Auto Refresh',
			'view_mode' => 'View Mode',
			'multi' => 'Multi',
			'context' => 'Context',
			'target' => 'Target',
			'auto_search' => 'Auto Search',
			'filter' => 'Filter',
			'src_model' => 'Src Model',
			'limit' => 'Limit',
			'res_id' => 'Res',
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
		$criteria->compare('view_id',$this->view_id);
		$criteria->compare('res_model',$this->res_model,true);
		$criteria->compare('view_type',$this->view_type,true);
		$criteria->compare('domain',$this->domain,true);
		$criteria->compare('search_view_id',$this->search_view_id);
		$criteria->compare('auto_refresh',$this->auto_refresh);
		$criteria->compare('view_mode',$this->view_mode,true);
		$criteria->compare('multi',$this->multi);
		$criteria->compare('context',$this->context,true);
		$criteria->compare('target',$this->target,true);
		$criteria->compare('auto_search',$this->auto_search);
		$criteria->compare('filter',$this->filter);
		$criteria->compare('src_model',$this->src_model,true);
		$criteria->compare('limit',$this->limit);
		$criteria->compare('res_id',$this->res_id);

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
	 * @return IrActWindow the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
