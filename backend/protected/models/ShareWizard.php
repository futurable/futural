<?php

/**
 * This is the model class for table "share_wizard".
 *
 * The followings are the available columns in table 'share_wizard':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $domain
 * @property string $record_name
 * @property boolean $invite
 * @property string $view_type
 * @property string $user_type
 * @property string $email_2
 * @property string $email_3
 * @property boolean $embed_option_search
 * @property string $message
 * @property string $name
 * @property boolean $embed_option_title
 * @property string $email_1
 * @property string $new_users
 * @property string $access_mode
 * @property integer $action_id
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property IrActWindow $action
 * @property ShareWizardResultLine[] $shareWizardResultLines
 */
class ShareWizard extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'share_wizard';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('view_type, user_type, name, access_mode, action_id', 'required'),
			array('create_uid, write_uid, action_id', 'numerical', 'integerOnly'=>true),
			array('domain', 'length', 'max'=>256),
			array('record_name', 'length', 'max'=>128),
			array('view_type', 'length', 'max'=>32),
			array('email_2, email_3, name, email_1', 'length', 'max'=>64),
			array('create_date, write_date, invite, embed_option_search, message, embed_option_title, new_users', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, domain, record_name, invite, view_type, user_type, email_2, email_3, embed_option_search, message, name, embed_option_title, email_1, new_users, access_mode, action_id', 'safe', 'on'=>'search'),
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
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'action' => array(self::BELONGS_TO, 'IrActWindow', 'action_id'),
			'shareWizardResultLines' => array(self::HAS_MANY, 'ShareWizardResultLine', 'share_wizard_id'),
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
			'domain' => 'Domain',
			'record_name' => 'Record Name',
			'invite' => 'Invite',
			'view_type' => 'View Type',
			'user_type' => 'User Type',
			'email_2' => 'Email 2',
			'email_3' => 'Email 3',
			'embed_option_search' => 'Embed Option Search',
			'message' => 'Message',
			'name' => 'Name',
			'embed_option_title' => 'Embed Option Title',
			'email_1' => 'Email 1',
			'new_users' => 'New Users',
			'access_mode' => 'Access Mode',
			'action_id' => 'Action',
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
		$criteria->compare('domain',$this->domain,true);
		$criteria->compare('record_name',$this->record_name,true);
		$criteria->compare('invite',$this->invite);
		$criteria->compare('view_type',$this->view_type,true);
		$criteria->compare('user_type',$this->user_type,true);
		$criteria->compare('email_2',$this->email_2,true);
		$criteria->compare('email_3',$this->email_3,true);
		$criteria->compare('embed_option_search',$this->embed_option_search);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('embed_option_title',$this->embed_option_title);
		$criteria->compare('email_1',$this->email_1,true);
		$criteria->compare('new_users',$this->new_users,true);
		$criteria->compare('access_mode',$this->access_mode,true);
		$criteria->compare('action_id',$this->action_id);

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
	 * @return ShareWizard the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
