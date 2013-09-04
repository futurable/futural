<?php

/**
 * This is the model class for table "crm_segmentation_line".
 *
 * The followings are the available columns in table 'crm_segmentation_line':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $expr_name
 * @property string $name
 * @property double $expr_value
 * @property string $operator
 * @property integer $segmentation_id
 * @property string $expr_operator
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property CrmSegmentation $segmentation
 * @property ResUsers $createU
 */
class CrmSegmentationLine extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'crm_segmentation_line';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('expr_name, name, expr_value, operator, expr_operator', 'required'),
			array('create_uid, write_uid, segmentation_id', 'numerical', 'integerOnly'=>true),
			array('expr_value', 'numerical'),
			array('expr_name, name', 'length', 'max'=>64),
			array('create_date, write_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, expr_name, name, expr_value, operator, segmentation_id, expr_operator', 'safe', 'on'=>'search'),
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
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'segmentation' => array(self::BELONGS_TO, 'CrmSegmentation', 'segmentation_id'),
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
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'expr_name' => 'Expr Name',
			'name' => 'Name',
			'expr_value' => 'Expr Value',
			'operator' => 'Operator',
			'segmentation_id' => 'Segmentation',
			'expr_operator' => 'Expr Operator',
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
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('expr_name',$this->expr_name,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('expr_value',$this->expr_value);
		$criteria->compare('operator',$this->operator,true);
		$criteria->compare('segmentation_id',$this->segmentation_id);
		$criteria->compare('expr_operator',$this->expr_operator,true);

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
	 * @return CrmSegmentationLine the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
