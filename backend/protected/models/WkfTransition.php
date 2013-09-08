<?php

/**
 * This is the model class for table "wkf_transition".
 *
 * The followings are the available columns in table 'wkf_transition':
 * @property integer $id
 * @property integer $act_from
 * @property integer $act_to
 * @property string $condition
 * @property string $trigger_type
 * @property string $trigger_expr_id
 * @property string $signal
 * @property integer $group_id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $trigger_model
 *
 * The followings are the available model relations:
 * @property ProcessTransitionIds[] $processTransitionIds
 * @property WkfWitmTrans[] $wkfWitmTrans
 * @property ResUsers $writeU
 * @property ResGroups $group
 * @property ResUsers $createU
 * @property WkfActivity $actTo
 * @property WkfActivity $actFrom
 */
class WkfTransition extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wkf_transition';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('act_from, act_to, condition', 'required'),
			array('act_from, act_to, group_id, create_uid, write_uid', 'numerical', 'integerOnly'=>true),
			array('condition, trigger_type, trigger_expr_id, trigger_model', 'length', 'max'=>128),
			array('signal', 'length', 'max'=>64),
			array('create_date, write_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, act_from, act_to, condition, trigger_type, trigger_expr_id, signal, group_id, create_uid, create_date, write_date, write_uid, trigger_model', 'safe', 'on'=>'search'),
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
			'processTransitionIds' => array(self::HAS_MANY, 'ProcessTransitionIds', 'wtr_id'),
			'wkfWitmTrans' => array(self::HAS_MANY, 'WkfWitmTrans', 'trans_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'group' => array(self::BELONGS_TO, 'ResGroups', 'group_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'actTo' => array(self::BELONGS_TO, 'WkfActivity', 'act_to'),
			'actFrom' => array(self::BELONGS_TO, 'WkfActivity', 'act_from'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'act_from' => 'Act From',
			'act_to' => 'Act To',
			'condition' => 'Condition',
			'trigger_type' => 'Trigger Type',
			'trigger_expr_id' => 'Trigger Expr',
			'signal' => 'Signal',
			'group_id' => 'Group',
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'trigger_model' => 'Trigger Model',
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
		$criteria->compare('act_from',$this->act_from);
		$criteria->compare('act_to',$this->act_to);
		$criteria->compare('condition',$this->condition,true);
		$criteria->compare('trigger_type',$this->trigger_type,true);
		$criteria->compare('trigger_expr_id',$this->trigger_expr_id,true);
		$criteria->compare('signal',$this->signal,true);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('trigger_model',$this->trigger_model,true);

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
	 * @return WkfTransition the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
