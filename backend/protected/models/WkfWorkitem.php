<?php

/**
 * This is the model class for table "wkf_workitem".
 *
 * The followings are the available columns in table 'wkf_workitem':
 * @property integer $id
 * @property integer $act_id
 * @property integer $inst_id
 * @property integer $subflow_id
 * @property string $state
 *
 * The followings are the available model relations:
 * @property WkfInstance $subflow
 * @property WkfInstance $inst
 * @property WkfActivity $act
 * @property WkfTriggers[] $wkfTriggers
 */
class WkfWorkitem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wkf_workitem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('act_id, inst_id', 'required'),
			array('act_id, inst_id, subflow_id', 'numerical', 'integerOnly'=>true),
			array('state', 'length', 'max'=>64),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, act_id, inst_id, subflow_id, state', 'safe', 'on'=>'search'),
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
			'subflow' => array(self::BELONGS_TO, 'WkfInstance', 'subflow_id'),
			'inst' => array(self::BELONGS_TO, 'WkfInstance', 'inst_id'),
			'act' => array(self::BELONGS_TO, 'WkfActivity', 'act_id'),
			'wkfTriggers' => array(self::HAS_MANY, 'WkfTriggers', 'workitem_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'act_id' => 'Act',
			'inst_id' => 'Inst',
			'subflow_id' => 'Subflow',
			'state' => 'State',
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
		$criteria->compare('act_id',$this->act_id);
		$criteria->compare('inst_id',$this->inst_id);
		$criteria->compare('subflow_id',$this->subflow_id);
		$criteria->compare('state',$this->state,true);

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
	 * @return WkfWorkitem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
