<?php

/**
 * This is the model class for table "account_automatic_reconcile".
 *
 * The followings are the available columns in table 'account_automatic_reconcile':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $power
 * @property double $max_amount
 * @property integer $reconciled
 * @property integer $unreconciled
 * @property boolean $allow_write_off
 * @property integer $writeoff_acc_id
 * @property integer $journal_id
 * @property integer $period_id
 *
 * The followings are the available model relations:
 * @property AccountAccount $writeoffAcc
 * @property ResUsers $writeU
 * @property AccountPeriod $period
 * @property AccountJournal $journal
 * @property ResUsers $createU
 * @property ReconcileAccountRel[] $reconcileAccountRels
 */
class AccountAutomaticReconcile extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_automatic_reconcile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('power', 'required'),
			array('create_uid, write_uid, power, reconciled, unreconciled, writeoff_acc_id, journal_id, period_id', 'numerical', 'integerOnly'=>true),
			array('max_amount', 'numerical'),
			array('create_date, write_date, allow_write_off', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, power, max_amount, reconciled, unreconciled, allow_write_off, writeoff_acc_id, journal_id, period_id', 'safe', 'on'=>'search'),
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
			'writeoffAcc' => array(self::BELONGS_TO, 'AccountAccount', 'writeoff_acc_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'period' => array(self::BELONGS_TO, 'AccountPeriod', 'period_id'),
			'journal' => array(self::BELONGS_TO, 'AccountJournal', 'journal_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'reconcileAccountRels' => array(self::HAS_MANY, 'ReconcileAccountRel', 'reconcile_id'),
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
			'power' => 'Power',
			'max_amount' => 'Max Amount',
			'reconciled' => 'Reconciled',
			'unreconciled' => 'Unreconciled',
			'allow_write_off' => 'Allow Write Off',
			'writeoff_acc_id' => 'Writeoff Acc',
			'journal_id' => 'Journal',
			'period_id' => 'Period',
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
		$criteria->compare('power',$this->power);
		$criteria->compare('max_amount',$this->max_amount);
		$criteria->compare('reconciled',$this->reconciled);
		$criteria->compare('unreconciled',$this->unreconciled);
		$criteria->compare('allow_write_off',$this->allow_write_off);
		$criteria->compare('writeoff_acc_id',$this->writeoff_acc_id);
		$criteria->compare('journal_id',$this->journal_id);
		$criteria->compare('period_id',$this->period_id);

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
	 * @return AccountAutomaticReconcile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
