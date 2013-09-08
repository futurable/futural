<?php

/**
 * This is the model class for table "ir_act_window_view".
 *
 * The followings are the available columns in table 'ir_act_window_view':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $act_window_id
 * @property boolean $multi
 * @property string $view_mode
 * @property integer $view_id
 * @property integer $sequence
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property IrUiView $view
 * @property ResUsers $createU
 * @property IrActWindow $actWindow
 */
class IrActWindowView extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_act_window_view';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('view_mode', 'required'),
			array('create_uid, write_uid, act_window_id, view_id, sequence', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date, multi', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, act_window_id, multi, view_mode, view_id, sequence', 'safe', 'on'=>'search'),
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
			'view' => array(self::BELONGS_TO, 'IrUiView', 'view_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'actWindow' => array(self::BELONGS_TO, 'IrActWindow', 'act_window_id'),
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
			'act_window_id' => 'Act Window',
			'multi' => 'Multi',
			'view_mode' => 'View Mode',
			'view_id' => 'View',
			'sequence' => 'Sequence',
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
		$criteria->compare('act_window_id',$this->act_window_id);
		$criteria->compare('multi',$this->multi);
		$criteria->compare('view_mode',$this->view_mode,true);
		$criteria->compare('view_id',$this->view_id);
		$criteria->compare('sequence',$this->sequence);

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
	 * @return IrActWindowView the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
