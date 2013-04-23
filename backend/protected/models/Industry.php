<?php

/**
 * This is the model class for table "Industry".
 *
 * The followings are the available columns in table 'Industry':
 * @property integer $ID
 * @property string $IndustryName
 * @property string $IndustryDescription
 *
 * The followings are the available model relations:
 * @property Company[] $companies
 * @property IndustrySettings[] $industrySettings
 */
class Industry extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Industry';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('IndustryName', 'required'),
			array('IndustryName', 'length', 'max'=>256),
			array('IndustryDescription', 'length', 'max'=>1024),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, IndustryName, IndustryDescription', 'safe', 'on'=>'search'),
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
			'companies' => array(self::HAS_MANY, 'Company', 'Industry_ID'),
			'industrySettings' => array(self::HAS_MANY, 'IndustrySettings', 'Industry_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'IndustryName' => 'Industry Name',
			'IndustryDescription' => 'Industry Description',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('IndustryName',$this->IndustryName,true);
		$criteria->compare('IndustryDescription',$this->IndustryDescription,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Industry the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
