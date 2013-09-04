<?php

/**
 * This is the model class for table "wkf_instance".
 *
 * The followings are the available columns in table 'wkf_instance':
 * @property integer $id
 * @property integer $wkf_id
 * @property integer $uid
 * @property integer $res_id
 * @property string $res_type
 * @property string $state
 *
 * The followings are the available model relations:
 * @property WkfWorkitem[] $wkfWorkitems
 * @property WkfWorkitem[] $wkfWorkitems1
 * @property WkfWitmTrans[] $wkfWitmTrans
 * @property WkfTriggers[] $wkfTriggers
 * @property Wkf $wkf
 */
class WkfInstance extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wkf_instance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('wkf_id, uid, res_id', 'numerical', 'integerOnly'=>true),
			array('res_type', 'length', 'max'=>64),
			array('state', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, wkf_id, uid, res_id, res_type, state', 'safe', 'on'=>'search'),
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
			'wkfWorkitems' => array(self::HAS_MANY, 'WkfWorkitem', 'subflow_id'),
			'wkfWorkitems1' => array(self::HAS_MANY, 'WkfWorkitem', 'inst_id'),
			'wkfWitmTrans' => array(self::HAS_MANY, 'WkfWitmTrans', 'inst_id'),
			'wkfTriggers' => array(self::HAS_MANY, 'WkfTriggers', 'instance_id'),
			'wkf' => array(self::BELONGS_TO, 'Wkf', 'wkf_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'wkf_id' => 'Wkf',
			'uid' => 'Uid',
			'res_id' => 'Res',
			'res_type' => 'Res Type',
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
		$criteria->compare('wkf_id',$this->wkf_id);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('res_id',$this->res_id);
		$criteria->compare('res_type',$this->res_type,true);
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
	 * @return WkfInstance the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
