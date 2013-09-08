<?php

/**
 * This is the model class for table "ir_ui_menu".
 *
 * The followings are the available columns in table 'ir_ui_menu':
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $icon
 * @property integer $parent_left
 * @property integer $parent_right
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $web_icon_data
 * @property integer $sequence
 * @property string $web_icon_hover
 * @property string $web_icon_hover_data
 * @property boolean $needaction_enabled
 * @property string $web_icon
 * @property integer $mail_group_id
 *
 * The followings are the available model relations:
 * @property BoardCreate[] $boardCreates
 * @property IrUiMenuGroupRel[] $irUiMenuGroupRels
 * @property WizardIrModelMenuCreate[] $wizardIrModelMenuCreates
 * @property ResUsers $writeU
 * @property IrUiMenu $parent
 * @property IrUiMenu[] $irUiMenus
 * @property MailGroup $mailGroup
 * @property ResUsers $createU
 * @property ProcessNode[] $processNodes
 * @property MailGroup[] $mailGroups
 */
class IrUiMenu extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_ui_menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, parent_left, parent_right, create_uid, write_uid, sequence, mail_group_id', 'numerical', 'integerOnly'=>true),
			array('name, icon', 'length', 'max'=>64),
			array('web_icon_hover, web_icon', 'length', 'max'=>128),
			array('create_date, write_date, web_icon_data, web_icon_hover_data, needaction_enabled', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_id, name, icon, parent_left, parent_right, create_uid, create_date, write_date, write_uid, web_icon_data, sequence, web_icon_hover, web_icon_hover_data, needaction_enabled, web_icon, mail_group_id', 'safe', 'on'=>'search'),
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
			'boardCreates' => array(self::HAS_MANY, 'BoardCreate', 'menu_parent_id'),
			'irUiMenuGroupRels' => array(self::HAS_MANY, 'IrUiMenuGroupRel', 'menu_id'),
			'wizardIrModelMenuCreates' => array(self::HAS_MANY, 'WizardIrModelMenuCreate', 'menu_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'parent' => array(self::BELONGS_TO, 'IrUiMenu', 'parent_id'),
			'irUiMenus' => array(self::HAS_MANY, 'IrUiMenu', 'parent_id'),
			'mailGroup' => array(self::BELONGS_TO, 'MailGroup', 'mail_group_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'processNodes' => array(self::HAS_MANY, 'ProcessNode', 'menu_id'),
			'mailGroups' => array(self::HAS_MANY, 'MailGroup', 'menu_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Parent',
			'name' => 'Name',
			'icon' => 'Icon',
			'parent_left' => 'Parent Left',
			'parent_right' => 'Parent Right',
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'web_icon_data' => 'Web Icon Data',
			'sequence' => 'Sequence',
			'web_icon_hover' => 'Web Icon Hover',
			'web_icon_hover_data' => 'Web Icon Hover Data',
			'needaction_enabled' => 'Needaction Enabled',
			'web_icon' => 'Web Icon',
			'mail_group_id' => 'Mail Group',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('parent_left',$this->parent_left);
		$criteria->compare('parent_right',$this->parent_right);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('web_icon_data',$this->web_icon_data,true);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('web_icon_hover',$this->web_icon_hover,true);
		$criteria->compare('web_icon_hover_data',$this->web_icon_hover_data,true);
		$criteria->compare('needaction_enabled',$this->needaction_enabled);
		$criteria->compare('web_icon',$this->web_icon,true);
		$criteria->compare('mail_group_id',$this->mail_group_id);

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
	 * @return IrUiMenu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
