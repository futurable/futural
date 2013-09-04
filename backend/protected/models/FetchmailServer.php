<?php

/**
 * This is the model class for table "fetchmail_server".
 *
 * The followings are the available columns in table 'fetchmail_server':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property boolean $active
 * @property string $user
 * @property string $date
 * @property string $configuration
 * @property integer $port
 * @property string $password
 * @property string $name
 * @property string $script
 * @property boolean $is_ssl
 * @property integer $object_id
 * @property string $server
 * @property integer $priority
 * @property boolean $attach
 * @property string $state
 * @property string $type
 * @property boolean $original
 * @property integer $action_id
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property IrModel $object
 * @property ResUsers $createU
 * @property IrActServer $action
 * @property MailMail[] $mailMails
 */
class FetchmailServer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fetchmail_server';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type', 'required'),
			array('create_uid, write_uid, port, object_id, priority, action_id', 'numerical', 'integerOnly'=>true),
			array('user, name, server', 'length', 'max'=>256),
			array('password', 'length', 'max'=>1024),
			array('script', 'length', 'max'=>64),
			array('create_date, write_date, active, date, configuration, is_ssl, attach, state, original', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, active, user, date, configuration, port, password, name, script, is_ssl, object_id, server, priority, attach, state, type, original, action_id', 'safe', 'on'=>'search'),
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
			'object' => array(self::BELONGS_TO, 'IrModel', 'object_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'action' => array(self::BELONGS_TO, 'IrActServer', 'action_id'),
			'mailMails' => array(self::HAS_MANY, 'MailMail', 'fetchmail_server_id'),
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
			'active' => 'Active',
			'user' => 'User',
			'date' => 'Date',
			'configuration' => 'Configuration',
			'port' => 'Port',
			'password' => 'Password',
			'name' => 'Name',
			'script' => 'Script',
			'is_ssl' => 'Is Ssl',
			'object_id' => 'Object',
			'server' => 'Server',
			'priority' => 'Priority',
			'attach' => 'Attach',
			'state' => 'State',
			'type' => 'Type',
			'original' => 'Original',
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
		$criteria->compare('active',$this->active);
		$criteria->compare('user',$this->user,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('configuration',$this->configuration,true);
		$criteria->compare('port',$this->port);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('script',$this->script,true);
		$criteria->compare('is_ssl',$this->is_ssl);
		$criteria->compare('object_id',$this->object_id);
		$criteria->compare('server',$this->server,true);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('attach',$this->attach);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('original',$this->original);
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
	 * @return FetchmailServer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
