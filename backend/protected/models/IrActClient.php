<?php

/**
 * This is the model class for table "ir_act_client".
 *
 * The followings are the available columns in table 'ir_act_client':
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $usage
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $help
 * @property string $res_model
 * @property string $params_store
 * @property string $tag
 * @property string $context
 */
class IrActClient extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_act_client';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, tag, context', 'required'),
			array('create_uid, write_uid', 'numerical', 'integerOnly'=>true),
			array('name, res_model, tag', 'length', 'max'=>64),
			array('type, usage', 'length', 'max'=>32),
			array('context', 'length', 'max'=>250),
			array('create_date, write_date, help, params_store', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, type, usage, create_uid, create_date, write_date, write_uid, help, res_model, params_store, tag, context', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'type' => 'Type',
			'usage' => 'Usage',
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'help' => 'Help',
			'res_model' => 'Res Model',
			'params_store' => 'Params Store',
			'tag' => 'Tag',
			'context' => 'Context',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('usage',$this->usage,true);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('help',$this->help,true);
		$criteria->compare('res_model',$this->res_model,true);
		$criteria->compare('params_store',$this->params_store,true);
		$criteria->compare('tag',$this->tag,true);
		$criteria->compare('context',$this->context,true);

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
	 * @return IrActClient the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
