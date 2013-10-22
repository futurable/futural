<?php

/**
 * This is the model class for table "remark".
 *
 * The followings are the available columns in table 'remark':
 * @property integer $id
 * @property string $description
 * @property string $event_date
 * @property string $create_date
 * @property integer $significance
 * @property integer $company_id
 *
 * The followings are the available model relations:
 * @property Company $company
 */
class Remark extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'remark';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_date, company_id', 'required'),
			array('significance, company_id', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>1024),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, description, event_date, create_date, significance, company_id', 'safe', 'on'=>'search'),
            array('create_date','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
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
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'description' => 'Description',
			'event_date' => 'Event Date',
			'create_date' => 'Create Date',
			'significance' => 'Significance',
			'company_id' => 'Company',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('event_date',$this->event_date,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('significance',$this->significance);
		$criteria->compare('company_id',$this->company_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Remark the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getSignificanceArray(){
        $array = array(
            '-3' => '-3 ('.Yii::t('Remark', 'Neglect').")",
            '-2' => '-2 ('.Yii::t('Remark', 'Slacking').")",
            '-1' => '-1 ('.Yii::t('Remark', 'Late').")",
            '0' => '0 ('.Yii::t('Remark', 'NoSignificance').")",
            '1' => '+1 ('.Yii::t('Remark', 'WellDone').")",
            '2' => '+2 ('.Yii::t('Remark', 'GreatWork').")",
            '3' => '+3 ('.Yii::t('Remark', 'Excellent').")",
        );
        
        return $array;
    }
}
