<?php

/**
 * This is the model class for table "base_config_settings".
 *
 * The followings are the available columns in table 'base_config_settings':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property boolean $module_portal
 * @property boolean $module_base_import
 * @property boolean $module_share
 * @property boolean $module_auth_oauth
 * @property boolean $module_portal_anonymous
 * @property boolean $module_multi_company
 * @property string $alias_domain
 * @property boolean $auth_signup_uninvited
 * @property boolean $auth_signup_reset_password
 * @property integer $auth_signup_template_user_id
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property ResUsers $authSignupTemplateUser
 */
class BaseConfigSettings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'base_config_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_uid, write_uid, auth_signup_template_user_id', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date, module_portal, module_base_import, module_share, module_auth_oauth, module_portal_anonymous, module_multi_company, alias_domain, auth_signup_uninvited, auth_signup_reset_password', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, module_portal, module_base_import, module_share, module_auth_oauth, module_portal_anonymous, module_multi_company, alias_domain, auth_signup_uninvited, auth_signup_reset_password, auth_signup_template_user_id', 'safe', 'on'=>'search'),
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
			'authSignupTemplateUser' => array(self::BELONGS_TO, 'ResUsers', 'auth_signup_template_user_id'),
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
			'module_portal' => 'Module Portal',
			'module_base_import' => 'Module Base Import',
			'module_share' => 'Module Share',
			'module_auth_oauth' => 'Module Auth Oauth',
			'module_portal_anonymous' => 'Module Portal Anonymous',
			'module_multi_company' => 'Module Multi Company',
			'alias_domain' => 'Alias Domain',
			'auth_signup_uninvited' => 'Auth Signup Uninvited',
			'auth_signup_reset_password' => 'Auth Signup Reset Password',
			'auth_signup_template_user_id' => 'Auth Signup Template User',
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
		$criteria->compare('module_portal',$this->module_portal);
		$criteria->compare('module_base_import',$this->module_base_import);
		$criteria->compare('module_share',$this->module_share);
		$criteria->compare('module_auth_oauth',$this->module_auth_oauth);
		$criteria->compare('module_portal_anonymous',$this->module_portal_anonymous);
		$criteria->compare('module_multi_company',$this->module_multi_company);
		$criteria->compare('alias_domain',$this->alias_domain,true);
		$criteria->compare('auth_signup_uninvited',$this->auth_signup_uninvited);
		$criteria->compare('auth_signup_reset_password',$this->auth_signup_reset_password);
		$criteria->compare('auth_signup_template_user_id',$this->auth_signup_template_user_id);

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
	 * @return BaseConfigSettings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
