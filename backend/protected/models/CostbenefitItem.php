<?php

/**
 * This is the model class for table "costbenefit_item".
 *
 * The followings are the available columns in table 'costbenefit_item':
 * @property integer $id
 * @property string $value
 * @property integer $costbenefit_calculation_id
 * @property integer $costbenefit_item_type_id
 *
 * The followings are the available model relations:
 * @property CostbenefitCalculation $costbenefitCalculation
 * @property CostbenefitItemType $costbenefitItemType
 */
class CostbenefitItem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'costbenefit_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('value, costbenefit_calculation_id, costbenefit_item_type_id', 'required'),
			array('costbenefit_calculation_id, costbenefit_item_type_id', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, value, costbenefit_calculation_id, costbenefit_item_type_id', 'safe', 'on'=>'search'),
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
			'costbenefitCalculation' => array(self::BELONGS_TO, 'CostbenefitCalculation', 'costbenefit_calculation_id'),
			'costbenefitItemType' => array(self::BELONGS_TO, 'CostbenefitItemType', 'costbenefit_item_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'value' => 'Value',
			'costbenefit_calculation_id' => 'Costbenefit Calculation',
			'costbenefit_item_type_id' => 'Costbenefit Item Type',
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
		$criteria->compare('value',$this->value,true);
		$criteria->compare('costbenefit_calculation_id',$this->costbenefit_calculation_id);
		$criteria->compare('costbenefit_item_type_id',$this->costbenefit_item_type_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CostbenefitItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
