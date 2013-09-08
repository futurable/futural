<?php

/**
 * This is the model class for table "mail_group".
 *
 * The followings are the available columns in table 'mail_group':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $menu_id
 * @property string $image_medium
 * @property string $name
 * @property integer $alias_id
 * @property string $image
 * @property string $image_small
 * @property integer $group_public_id
 * @property string $public
 * @property string $description
 *
 * The followings are the available model relations:
 * @property MailGroupResGroupRel[] $mailGroupResGroupRels
 * @property IrUiMenu[] $irUiMenus
 * @property ResUsers $writeU
 * @property IrUiMenu $menu
 * @property ResGroups $groupPublic
 * @property ResUsers $createU
 * @property MailAlias $alias
 */
class MailGroup extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mail_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu_id, name, alias_id, public', 'required'),
			array('create_uid, write_uid, menu_id, alias_id, group_public_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, image_medium, image, image_small, description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, menu_id, image_medium, name, alias_id, image, image_small, group_public_id, public, description', 'safe', 'on'=>'search'),
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
			'mailGroupResGroupRels' => array(self::HAS_MANY, 'MailGroupResGroupRel', 'mail_group_id'),
			'irUiMenus' => array(self::HAS_MANY, 'IrUiMenu', 'mail_group_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'menu' => array(self::BELONGS_TO, 'IrUiMenu', 'menu_id'),
			'groupPublic' => array(self::BELONGS_TO, 'ResGroups', 'group_public_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'alias' => array(self::BELONGS_TO, 'MailAlias', 'alias_id'),
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
			'menu_id' => 'Menu',
			'image_medium' => 'Image Medium',
			'name' => 'Name',
			'alias_id' => 'Alias',
			'image' => 'Image',
			'image_small' => 'Image Small',
			'group_public_id' => 'Group Public',
			'public' => 'Public',
			'description' => 'Description',
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
		$criteria->compare('menu_id',$this->menu_id);
		$criteria->compare('image_medium',$this->image_medium,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('alias_id',$this->alias_id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('image_small',$this->image_small,true);
		$criteria->compare('group_public_id',$this->group_public_id);
		$criteria->compare('public',$this->public,true);
		$criteria->compare('description',$this->description,true);

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
	 * @return MailGroup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
