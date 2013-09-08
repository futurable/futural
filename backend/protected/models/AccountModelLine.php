<?php

/**
 * This is the model class for table "account_model_line".
 *
 * The followings are the available columns in table 'account_model_line':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $analytic_account_id
 * @property integer $model_id
 * @property integer $account_id
 * @property integer $sequence
 * @property integer $currency_id
 * @property string $credit
 * @property string $date_maturity
 * @property string $debit
 * @property double $amount_currency
 * @property string $quantity
 * @property integer $partner_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ResPartner $partner
 * @property AccountModel $model
 * @property ResCurrency $currency
 * @property ResUsers $createU
 * @property AccountAnalyticAccount $analyticAccount
 * @property AccountAccount $account
 */
class AccountModelLine extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_model_line';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('model_id, account_id, sequence, name', 'required'),
			array('create_uid, write_uid, analytic_account_id, model_id, account_id, sequence, currency_id, partner_id', 'numerical', 'integerOnly'=>true),
			array('amount_currency', 'numerical'),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, credit, date_maturity, debit, quantity', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, analytic_account_id, model_id, account_id, sequence, currency_id, credit, date_maturity, debit, amount_currency, quantity, partner_id, name', 'safe', 'on'=>'search'),
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
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'model' => array(self::BELONGS_TO, 'AccountModel', 'model_id'),
			'currency' => array(self::BELONGS_TO, 'ResCurrency', 'currency_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'analyticAccount' => array(self::BELONGS_TO, 'AccountAnalyticAccount', 'analytic_account_id'),
			'account' => array(self::BELONGS_TO, 'AccountAccount', 'account_id'),
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
			'analytic_account_id' => 'Analytic Account',
			'model_id' => 'Model',
			'account_id' => 'Account',
			'sequence' => 'Sequence',
			'currency_id' => 'Currency',
			'credit' => 'Credit',
			'date_maturity' => 'Date Maturity',
			'debit' => 'Debit',
			'amount_currency' => 'Amount Currency',
			'quantity' => 'Quantity',
			'partner_id' => 'Partner',
			'name' => 'Name',
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
		$criteria->compare('analytic_account_id',$this->analytic_account_id);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('credit',$this->credit,true);
		$criteria->compare('date_maturity',$this->date_maturity,true);
		$criteria->compare('debit',$this->debit,true);
		$criteria->compare('amount_currency',$this->amount_currency);
		$criteria->compare('quantity',$this->quantity,true);
		$criteria->compare('partner_id',$this->partner_id);
		$criteria->compare('name',$this->name,true);

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
	 * @return AccountModelLine the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
