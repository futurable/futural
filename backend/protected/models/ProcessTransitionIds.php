<?php

/**
 * This is the model class for table "process_transition_ids".
 *
 * The followings are the available columns in table 'process_transition_ids':
 * @property integer $ptr_id
 * @property integer $wtr_id
 *
 * The followings are the available model relations:
 * @property WkfTransition $wtr
 * @property ProcessTransition $ptr
 */
class ProcessTransitionIds extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'process_transition_ids';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ptr_id, wtr_id', 'required'),
			array('ptr_id, wtr_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ptr_id, wtr_id', 'safe', 'on'=>'search'),
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
			'wtr' => array(self::BELONGS_TO, 'WkfTransition', 'wtr_id'),
			'ptr' => array(self::BELONGS_TO, 'ProcessTransition', 'ptr_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ptr_id' => 'Ptr',
			'wtr_id' => 'Wtr',
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

		$criteria->compare('ptr_id',$this->ptr_id);
		$criteria->compare('wtr_id',$this->wtr_id);

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
	 * @return ProcessTransitionIds the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
