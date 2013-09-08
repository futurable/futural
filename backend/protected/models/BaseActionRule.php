<?php

/**
 * This is the model class for table "base_action_rule".
 *
 * The followings are the available columns in table 'base_action_rule':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $model_id
 * @property integer $filter_pre_id
 * @property integer $sequence
 * @property integer $act_user_id
 * @property string $last_run
 * @property integer $trg_date_id
 * @property string $trg_date_range_type
 * @property integer $filter_id
 * @property boolean $active
 * @property integer $trg_date_range
 * @property string $name
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property IrModelFields $trgDate
 * @property IrModel $model
 * @property IrFilters $filterPre
 * @property IrFilters $filter
 * @property ResUsers $createU
 * @property ResUsers $actUser
 * @property BaseActionRuleIrActServerRel[] $baseActionRuleIrActServerRels
 * @property BaseActionRuleResPartnerRel[] $baseActionRuleResPartnerRels
 */
class BaseActionRule extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'base_action_rule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('model_id, name', 'required'),
			array('create_uid, write_uid, model_id, filter_pre_id, sequence, act_user_id, trg_date_id, filter_id, trg_date_range', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, last_run, trg_date_range_type, active', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, model_id, filter_pre_id, sequence, act_user_id, last_run, trg_date_id, trg_date_range_type, filter_id, active, trg_date_range, name', 'safe', 'on'=>'search'),
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
			'trgDate' => array(self::BELONGS_TO, 'IrModelFields', 'trg_date_id'),
			'model' => array(self::BELONGS_TO, 'IrModel', 'model_id'),
			'filterPre' => array(self::BELONGS_TO, 'IrFilters', 'filter_pre_id'),
			'filter' => array(self::BELONGS_TO, 'IrFilters', 'filter_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'actUser' => array(self::BELONGS_TO, 'ResUsers', 'act_user_id'),
			'baseActionRuleIrActServerRels' => array(self::HAS_MANY, 'BaseActionRuleIrActServerRel', 'base_action_rule_id'),
			'baseActionRuleResPartnerRels' => array(self::HAS_MANY, 'BaseActionRuleResPartnerRel', 'base_action_rule_id'),
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
			'filter_pre_id' => 'Filter Pre',
			'sequence' => 'Sequence',
			'act_user_id' => 'Act User',
			'last_run' => 'Last Run',
			'trg_date_id' => 'Trg Date',
			'trg_date_range_type' => 'Trg Date Range Type',
			'filter_id' => 'Filter',
			'active' => 'Active',
			'trg_date_range' => 'Trg Date Range',
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
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('filter_pre_id',$this->filter_pre_id);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('act_user_id',$this->act_user_id);
		$criteria->compare('last_run',$this->last_run,true);
		$criteria->compare('trg_date_id',$this->trg_date_id);
		$criteria->compare('trg_date_range_type',$this->trg_date_range_type,true);
		$criteria->compare('filter_id',$this->filter_id);
		$criteria->compare('active',$this->active);
		$criteria->compare('trg_date_range',$this->trg_date_range);
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
	 * @return BaseActionRule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
