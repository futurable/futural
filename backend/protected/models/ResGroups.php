<?php

/**
 * This is the model class for table "res_groups".
 *
 * The followings are the available columns in table 'res_groups':
 * @property integer $id
 * @property string $name
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $comment
 * @property integer $category_id
 * @property boolean $share
 *
 * The followings are the available model relations:
 * @property AccountJournalGroupRel[] $accountJournalGroupRels
 * @property IrModelFieldsGroupRel[] $irModelFieldsGroupRels
 * @property IrUiMenuGroupRel[] $irUiMenuGroupRels
 * @property MailGroupResGroupRel[] $mailGroupResGroupRels
 * @property ResGroupsUsersRel[] $resGroupsUsersRels
 * @property ResGroupsReportRel[] $resGroupsReportRels
 * @property ResGroupsWizardRel[] $resGroupsWizardRels
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property IrModuleCategory $category
 * @property RuleGroupRel[] $ruleGroupRels
 * @property IrActWindowGroupRel[] $irActWindowGroupRels
 * @property IrModelAccess[] $irModelAccesses
 * @property IrUiViewGroupRel[] $irUiViewGroupRels
 * @property ResGroupsImpliedRel[] $resGroupsImpliedRels
 * @property ResGroupsImpliedRel[] $resGroupsImpliedRels1
 * @property ResGroupsActionRel[] $resGroupsActionRels
 * @property MailGroup[] $mailGroups
 * @property ProcessTransitionGroupRel[] $processTransitionGroupRels
 * @property WkfTransition[] $wkfTransitions
 */
class ResGroups extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'res_groups';
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
			array('create_uid, write_uid, category_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, comment, share', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, create_uid, create_date, write_date, write_uid, comment, category_id, share', 'safe', 'on'=>'search'),
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
			'accountJournalGroupRels' => array(self::HAS_MANY, 'AccountJournalGroupRel', 'group_id'),
			'irModelFieldsGroupRels' => array(self::HAS_MANY, 'IrModelFieldsGroupRel', 'group_id'),
			'irUiMenuGroupRels' => array(self::HAS_MANY, 'IrUiMenuGroupRel', 'gid'),
			'mailGroupResGroupRels' => array(self::HAS_MANY, 'MailGroupResGroupRel', 'groups_id'),
			'resGroupsUsersRels' => array(self::HAS_MANY, 'ResGroupsUsersRel', 'gid'),
			'resGroupsReportRels' => array(self::HAS_MANY, 'ResGroupsReportRel', 'gid'),
			'resGroupsWizardRels' => array(self::HAS_MANY, 'ResGroupsWizardRel', 'gid'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'category' => array(self::BELONGS_TO, 'IrModuleCategory', 'category_id'),
			'ruleGroupRels' => array(self::HAS_MANY, 'RuleGroupRel', 'group_id'),
			'irActWindowGroupRels' => array(self::HAS_MANY, 'IrActWindowGroupRel', 'gid'),
			'irModelAccesses' => array(self::HAS_MANY, 'IrModelAccess', 'group_id'),
			'irUiViewGroupRels' => array(self::HAS_MANY, 'IrUiViewGroupRel', 'group_id'),
			'resGroupsImpliedRels' => array(self::HAS_MANY, 'ResGroupsImpliedRel', 'hid'),
			'resGroupsImpliedRels1' => array(self::HAS_MANY, 'ResGroupsImpliedRel', 'gid'),
			'resGroupsActionRels' => array(self::HAS_MANY, 'ResGroupsActionRel', 'gid'),
			'mailGroups' => array(self::HAS_MANY, 'MailGroup', 'group_public_id'),
			'processTransitionGroupRels' => array(self::HAS_MANY, 'ProcessTransitionGroupRel', 'rid'),
			'wkfTransitions' => array(self::HAS_MANY, 'WkfTransition', 'group_id'),
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
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'comment' => 'Comment',
			'category_id' => 'Category',
			'share' => 'Share',
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
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('share',$this->share);

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
	 * @return ResGroups the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
