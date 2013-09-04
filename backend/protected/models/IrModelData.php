<?php

/**
 * This is the model class for table "ir_model_data".
 *
 * The followings are the available columns in table 'ir_model_data':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property boolean $noupdate
 * @property string $name
 * @property string $date_init
 * @property string $date_update
 * @property string $module
 * @property string $model
 * @property integer $res_id
 */
class IrModelData extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_model_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, module, model', 'required'),
			array('create_uid, write_uid, res_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			array('module, model', 'length', 'max'=>64),
			array('create_date, write_date, noupdate, date_init, date_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, noupdate, name, date_init, date_update, module, model, res_id', 'safe', 'on'=>'search'),
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
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'noupdate' => 'Noupdate',
			'name' => 'Name',
			'date_init' => 'Date Init',
			'date_update' => 'Date Update',
			'module' => 'Module',
			'model' => 'Model',
			'res_id' => 'Res',
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
		$criteria->compare('noupdate',$this->noupdate);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('date_init',$this->date_init,true);
		$criteria->compare('date_update',$this->date_update,true);
		$criteria->compare('module',$this->module,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('res_id',$this->res_id);

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
	 * @return IrModelData the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
