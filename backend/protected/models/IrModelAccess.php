<?php

/**
 * This is the model class for table "ir_model_access".
 *
 * The followings are the available columns in table 'ir_model_access':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $model_id
 * @property boolean $perm_read
 * @property string $name
 * @property boolean $perm_write
 * @property boolean $perm_unlink
 * @property boolean $active
 * @property boolean $perm_create
 * @property integer $group_id
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property IrModel $model
 * @property ResGroups $group
 * @property ResUsers $createU
 */
class IrModelAccess extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_model_access';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('model_id, name', 'required'),
			array('create_uid, write_uid, model_id, group_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, perm_read, perm_write, perm_unlink, active, perm_create', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, model_id, perm_read, name, perm_write, perm_unlink, active, perm_create, group_id', 'safe', 'on'=>'search'),
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
			'model' => array(self::BELONGS_TO, 'IrModel', 'model_id'),
			'group' => array(self::BELONGS_TO, 'ResGroups', 'group_id'),
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
			'model_id' => 'Model',
			'perm_read' => 'Perm Read',
			'name' => 'Name',
			'perm_write' => 'Perm Write',
			'perm_unlink' => 'Perm Unlink',
			'active' => 'Active',
			'perm_create' => 'Perm Create',
			'group_id' => 'Group',
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
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('perm_read',$this->perm_read);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('perm_write',$this->perm_write);
		$criteria->compare('perm_unlink',$this->perm_unlink);
		$criteria->compare('active',$this->active);
		$criteria->compare('perm_create',$this->perm_create);
		$criteria->compare('group_id',$this->group_id);

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
	 * @return IrModelAccess the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
