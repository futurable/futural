<?php

/**
 * This is the model class for table "bank_loan_transaction".
 *
 * The followings are the available columns in table 'bank_loan_transaction':
 * @property integer $id
 * @property integer $sequence_number
 * @property string $instalment_amount
 * @property string $interest_amount
 * @property string $notification_penalty_sent
 * @property string $create_date
 * @property string $due_date
 * @property string $event_date
 * @property integer $bank_loan_id
 * @property integer $bank_account_transaction_id
 */
class BankLoanTransaction extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bank_loan_transaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bank_loan_id, bank_account_transaction_id', 'required'),
			array('sequence_number, bank_loan_id, bank_account_transaction_id', 'numerical', 'integerOnly'=>true),
			array('instalment_amount, interest_amount', 'length', 'max'=>19),
			array('notification_penalty_sent', 'length', 'max'=>5),
			array('create_date, due_date, event_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sequence_number, instalment_amount, interest_amount, notification_penalty_sent, create_date, due_date, event_date, bank_loan_id, bank_account_transaction_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sequence_number' => 'Sequence Number',
			'instalment_amount' => 'Instalment Amount',
			'interest_amount' => 'Interest Amount',
			'notification_penalty_sent' => 'Notification Penalty Sent',
			'create_date' => 'Create Date',
			'due_date' => 'Due Date',
			'event_date' => 'Event Date',
			'bank_loan_id' => 'Bank Loan',
			'bank_account_transaction_id' => 'Bank Account Transaction',
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
		$criteria->compare('sequence_number',$this->sequence_number);
		$criteria->compare('instalment_amount',$this->instalment_amount,true);
		$criteria->compare('interest_amount',$this->interest_amount,true);
		$criteria->compare('notification_penalty_sent',$this->notification_penalty_sent,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('event_date',$this->event_date,true);
		$criteria->compare('bank_loan_id',$this->bank_loan_id);
		$criteria->compare('bank_account_transaction_id',$this->bank_account_transaction_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->dbbank;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BankLoanTransaction the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
