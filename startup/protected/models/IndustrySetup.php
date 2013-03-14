<?php

/**
 * This is the model class for table "industry_setup".
 *
 * The followings are the available columns in table 'industry_setup':
 * @property integer $id
 * @property string $turnover
 * @property string $minimum_wage_rate
 * @property string $average_wage_rate
 * @property string $maximum_wage_rate
 * @property integer $industry_id
 *
 * The followings are the available model relations:
 * @property Industry $industry
 */
class IndustrySetup extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'industry_setup';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('turnover, minimum_wage_rate, industry_id', 'required'),
			array('industry_id', 'numerical', 'integerOnly'=>true),
			array('turnover, minimum_wage_rate, average_wage_rate, maximum_wage_rate', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, turnover, minimum_wage_rate, average_wage_rate, maximum_wage_rate, industry_id', 'safe', 'on'=>'search'),
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
			'industry' => array(self::BELONGS_TO, 'Industry', 'industry_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'turnover' => 'Turnover',
			'minimum_wage_rate' => 'Minimum Wage Rate',
			'average_wage_rate' => 'Average Wage Rate',
			'maximum_wage_rate' => 'Maximum Wage Rate',
			'industry_id' => 'Industry',
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
		$criteria->compare('turnover',$this->turnover,true);
		$criteria->compare('minimum_wage_rate',$this->minimum_wage_rate,true);
		$criteria->compare('average_wage_rate',$this->average_wage_rate,true);
		$criteria->compare('maximum_wage_rate',$this->maximum_wage_rate,true);
		$criteria->compare('industry_id',$this->industry_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return IndustrySetup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
