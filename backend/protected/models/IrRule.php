<?php

/**
 * This is the model class for table "ir_rule".
 *
 * The followings are the available columns in table 'ir_rule':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $model_id
 * @property string $domain_force
 * @property string $name
 * @property boolean $global
 * @property boolean $active
 * @property boolean $perm_unlink
 * @property boolean $perm_write
 * @property boolean $perm_read
 * @property boolean $perm_create
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property IrModel $model
 * @property ResUsers $createU
 * @property RuleGroupRel[] $ruleGroupRels
 */
class IrRule extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_rule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('model_id', 'required'),
			array('create_uid, write_uid, model_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			array('create_date, write_date, domain_force, global, active, perm_unlink, perm_write, perm_read, perm_create', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, model_id, domain_force, name, global, active, perm_unlink, perm_write, perm_read, perm_create', 'safe', 'on'=>'search'),
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
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'ruleGroupRels' => array(self::HAS_MANY, 'RuleGroupRel', 'rule_group_id'),
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
			'domain_force' => 'Domain Force',
			'name' => 'Name',
			'global' => 'Global',
			'active' => 'Active',
			'perm_unlink' => 'Perm Unlink',
			'perm_write' => 'Perm Write',
			'perm_read' => 'Perm Read',
			'perm_create' => 'Perm Create',
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
		$criteria->compare('domain_force',$this->domain_force,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('global',$this->global);
		$criteria->compare('active',$this->active);
		$criteria->compare('perm_unlink',$this->perm_unlink);
		$criteria->compare('perm_write',$this->perm_write);
		$criteria->compare('perm_read',$this->perm_read);
		$criteria->compare('perm_create',$this->perm_create);

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
	 * @return IrRule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
