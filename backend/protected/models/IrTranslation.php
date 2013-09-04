<?php

/**
 * This is the model class for table "ir_translation".
 *
 * The followings are the available columns in table 'ir_translation':
 * @property integer $id
 * @property string $lang
 * @property string $src
 * @property string $name
 * @property integer $res_id
 * @property string $module
 * @property string $state
 * @property string $value
 * @property string $type
 * @property string $comments
 *
 * The followings are the available model relations:
 * @property ResLang $lang0
 */
class IrTranslation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_translation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('res_id', 'numerical', 'integerOnly'=>true),
			array('lang, src, module, state, value, type, comments', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, lang, src, name, res_id, module, state, value, type, comments', 'safe', 'on'=>'search'),
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
			'lang0' => array(self::BELONGS_TO, 'ResLang', 'lang'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'lang' => 'Lang',
			'src' => 'Src',
			'name' => 'Name',
			'res_id' => 'Res',
			'module' => 'Module',
			'state' => 'State',
			'value' => 'Value',
			'type' => 'Type',
			'comments' => 'Comments',
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
		$criteria->compare('lang',$this->lang,true);
		$criteria->compare('src',$this->src,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('res_id',$this->res_id);
		$criteria->compare('module',$this->module,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('comments',$this->comments,true);

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
	 * @return IrTranslation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
