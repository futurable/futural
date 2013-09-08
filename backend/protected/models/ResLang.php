<?php

/**
 * This is the model class for table "res_lang".
 *
 * The followings are the available columns in table 'res_lang':
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $date_format
 * @property string $direction
 * @property string $thousands_sep
 * @property boolean $translatable
 * @property string $time_format
 * @property string $decimal_point
 * @property boolean $active
 * @property string $iso_code
 * @property string $grouping
 *
 * The followings are the available model relations:
 * @property IrTranslation[] $irTranslations
 * @property ResUsers $writeU
 * @property ResUsers $createU
 */
class ResLang extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'res_lang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, code, date_format, direction, time_format, decimal_point, grouping', 'required'),
			array('create_uid, write_uid', 'numerical', 'integerOnly'=>true),
			array('name, date_format, thousands_sep, time_format, decimal_point, grouping', 'length', 'max'=>64),
			array('code, iso_code', 'length', 'max'=>16),
			array('create_date, write_date, translatable, active', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, code, create_uid, create_date, write_date, write_uid, date_format, direction, thousands_sep, translatable, time_format, decimal_point, active, iso_code, grouping', 'safe', 'on'=>'search'),
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
			'irTranslations' => array(self::HAS_MANY, 'IrTranslation', 'lang'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'code' => 'Code',
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'date_format' => 'Date Format',
			'direction' => 'Direction',
			'thousands_sep' => 'Thousands Sep',
			'translatable' => 'Translatable',
			'time_format' => 'Time Format',
			'decimal_point' => 'Decimal Point',
			'active' => 'Active',
			'iso_code' => 'Iso Code',
			'grouping' => 'Grouping',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('date_format',$this->date_format,true);
		$criteria->compare('direction',$this->direction,true);
		$criteria->compare('thousands_sep',$this->thousands_sep,true);
		$criteria->compare('translatable',$this->translatable);
		$criteria->compare('time_format',$this->time_format,true);
		$criteria->compare('decimal_point',$this->decimal_point,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('iso_code',$this->iso_code,true);
		$criteria->compare('grouping',$this->grouping,true);

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
	 * @return ResLang the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
