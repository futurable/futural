<?php

/**
 * This is the model class for table "bank_profile_field".
 *
 * The followings are the available columns in table 'bank_profile_field':
 * @property integer $id
 * @property string $varname
 * @property string $title
 * @property string $field_type
 * @property integer $field_size
 * @property integer $field_size_min
 * @property integer $required
 * @property string $match
 * @property string $range
 * @property string $error_message
 * @property string $other_validator
 * @property string $default
 * @property string $widget
 * @property string $widgetparams
 * @property integer $position
 * @property integer $visible
 */
class BankProfileField extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bank_profile_field';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('varname, title, field_type', 'required'),
			array('field_size, field_size_min, required, position, visible', 'numerical', 'integerOnly'=>true),
			array('varname, field_type', 'length', 'max'=>50),
			array('title, match, range, error_message, default, widget', 'length', 'max'=>255),
			array('other_validator, widgetparams', 'length', 'max'=>5000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, varname, title, field_type, field_size, field_size_min, required, match, range, error_message, other_validator, default, widget, widgetparams, position, visible', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'varname' => 'Varname',
			'title' => 'Title',
			'field_type' => 'Field Type',
			'field_size' => 'Field Size',
			'field_size_min' => 'Field Size Min',
			'required' => 'Required',
			'match' => 'Match',
			'range' => 'Range',
			'error_message' => 'Error Message',
			'other_validator' => 'Other Validator',
			'default' => 'Default',
			'widget' => 'Widget',
			'widgetparams' => 'Widgetparams',
			'position' => 'Position',
			'visible' => 'Visible',
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
		$criteria->compare('varname',$this->varname,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('field_type',$this->field_type,true);
		$criteria->compare('field_size',$this->field_size);
		$criteria->compare('field_size_min',$this->field_size_min);
		$criteria->compare('required',$this->required);
		$criteria->compare('match',$this->match,true);
		$criteria->compare('range',$this->range,true);
		$criteria->compare('error_message',$this->error_message,true);
		$criteria->compare('other_validator',$this->other_validator,true);
		$criteria->compare('default',$this->default,true);
		$criteria->compare('widget',$this->widget,true);
		$criteria->compare('widgetparams',$this->widgetparams,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('visible',$this->visible);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->dbbank;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BankProfileField the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
