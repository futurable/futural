<?php

/**
 * This is the model class for table "account_invoice_refund".
 *
 * The followings are the available columns in table 'account_invoice_refund':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $date
 * @property integer $journal_id
 * @property string $filter_refund
 * @property string $description
 * @property integer $period
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property AccountPeriod $period0
 * @property AccountJournal $journal
 * @property ResUsers $createU
 */
class AccountInvoiceRefund extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_invoice_refund';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('filter_refund, description', 'required'),
			array('create_uid, write_uid, journal_id, period', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>128),
			array('create_date, write_date, date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, date, journal_id, filter_refund, description, period', 'safe', 'on'=>'search'),
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
			'period0' => array(self::BELONGS_TO, 'AccountPeriod', 'period'),
			'journal' => array(self::BELONGS_TO, 'AccountJournal', 'journal_id'),
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
			'date' => 'Date',
			'journal_id' => 'Journal',
			'filter_refund' => 'Filter Refund',
			'description' => 'Description',
			'period' => 'Period',
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('journal_id',$this->journal_id);
		$criteria->compare('filter_refund',$this->filter_refund,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('period',$this->period);

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
	 * @return AccountInvoiceRefund the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
