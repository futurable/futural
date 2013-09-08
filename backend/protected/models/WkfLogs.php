<?php

/**
 * This is the model class for table "wkf_logs".
 *
 * The followings are the available columns in table 'wkf_logs':
 * @property integer $id
 * @property string $res_type
 * @property integer $res_id
 * @property integer $uid
 * @property integer $act_id
 * @property string $time
 * @property string $info
 *
 * The followings are the available model relations:
 * @property ResUsers $u
 * @property WkfActivity $act
 */
class WkfLogs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wkf_logs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('res_type, res_id, time', 'required'),
			array('res_id, uid, act_id', 'numerical', 'integerOnly'=>true),
			array('res_type, info', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, res_type, res_id, uid, act_id, time, info', 'safe', 'on'=>'search'),
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
			'u' => array(self::BELONGS_TO, 'ResUsers', 'uid'),
			'act' => array(self::BELONGS_TO, 'WkfActivity', 'act_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'res_type' => 'Res Type',
			'res_id' => 'Res',
			'uid' => 'Uid',
			'act_id' => 'Act',
			'time' => 'Time',
			'info' => 'Info',
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
		$criteria->compare('res_type',$this->res_type,true);
		$criteria->compare('res_id',$this->res_id);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('act_id',$this->act_id);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('info',$this->info,true);

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
	 * @return WkfLogs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
