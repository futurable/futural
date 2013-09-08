<?php

/**
 * This is the model class for table "account_voucher_line".
 *
 * The followings are the available columns in table 'account_voucher_line':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property boolean $reconcile
 * @property integer $voucher_id
 * @property string $amount_unreconciled
 * @property integer $account_id
 * @property string $name
 * @property integer $move_line_id
 * @property double $untax_amount
 * @property integer $company_id
 * @property string $amount_original
 * @property string $amount
 * @property integer $account_analytic_id
 * @property string $type
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property AccountVoucher $voucher
 * @property AccountMoveLine $moveLine
 * @property ResUsers $createU
 * @property AccountAccount $account
 * @property AccountAnalyticAccount $accountAnalytic
 */
class AccountVoucherLine extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_voucher_line';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('voucher_id, account_id', 'required'),
			array('create_uid, write_uid, voucher_id, account_id, move_line_id, company_id, account_analytic_id', 'numerical', 'integerOnly'=>true),
			array('untax_amount', 'numerical'),
			array('name', 'length', 'max'=>256),
			array('create_date, write_date, reconcile, amount_unreconciled, amount_original, amount, type', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, reconcile, voucher_id, amount_unreconciled, account_id, name, move_line_id, untax_amount, company_id, amount_original, amount, account_analytic_id, type', 'safe', 'on'=>'search'),
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
			'voucher' => array(self::BELONGS_TO, 'AccountVoucher', 'voucher_id'),
			'moveLine' => array(self::BELONGS_TO, 'AccountMoveLine', 'move_line_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'account' => array(self::BELONGS_TO, 'AccountAccount', 'account_id'),
			'accountAnalytic' => array(self::BELONGS_TO, 'AccountAnalyticAccount', 'account_analytic_id'),
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
			'reconcile' => 'Reconcile',
			'voucher_id' => 'Voucher',
			'amount_unreconciled' => 'Amount Unreconciled',
			'account_id' => 'Account',
			'name' => 'Name',
			'move_line_id' => 'Move Line',
			'untax_amount' => 'Untax Amount',
			'company_id' => 'Company',
			'amount_original' => 'Amount Original',
			'amount' => 'Amount',
			'account_analytic_id' => 'Account Analytic',
			'type' => 'Type',
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
		$criteria->compare('reconcile',$this->reconcile);
		$criteria->compare('voucher_id',$this->voucher_id);
		$criteria->compare('amount_unreconciled',$this->amount_unreconciled,true);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('move_line_id',$this->move_line_id);
		$criteria->compare('untax_amount',$this->untax_amount);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('amount_original',$this->amount_original,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('account_analytic_id',$this->account_analytic_id);
		$criteria->compare('type',$this->type,true);

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
	 * @return AccountVoucherLine the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
