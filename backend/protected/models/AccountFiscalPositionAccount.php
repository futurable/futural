<?php

/**
 * This is the model class for table "account_fiscal_position_account".
 *
 * The followings are the available columns in table 'account_fiscal_position_account':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $position_id
 * @property integer $account_dest_id
 * @property integer $account_src_id
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property AccountFiscalPosition $position
 * @property ResUsers $createU
 * @property AccountAccount $accountSrc
 * @property AccountAccount $accountDest
 */
class AccountFiscalPositionAccount extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_fiscal_position_account';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('position_id, account_dest_id, account_src_id', 'required'),
			array('create_uid, write_uid, position_id, account_dest_id, account_src_id', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, position_id, account_dest_id, account_src_id', 'safe', 'on'=>'search'),
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
			'position' => array(self::BELONGS_TO, 'AccountFiscalPosition', 'position_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'accountSrc' => array(self::BELONGS_TO, 'AccountAccount', 'account_src_id'),
			'accountDest' => array(self::BELONGS_TO, 'AccountAccount', 'account_dest_id'),
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
			'position_id' => 'Position',
			'account_dest_id' => 'Account Dest',
			'account_src_id' => 'Account Src',
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
		$criteria->compare('position_id',$this->position_id);
		$criteria->compare('account_dest_id',$this->account_dest_id);
		$criteria->compare('account_src_id',$this->account_src_id);

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
	 * @return AccountFiscalPositionAccount the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
