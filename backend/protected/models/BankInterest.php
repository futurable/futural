<?php

/**
 * This is the model class for table "bank_interest".
 *
 * The followings are the available columns in table 'bank_interest':
 * @property integer $id
 * @property string $rate
 * @property string $name
 * @property string $create_date
 * @property string $modify_date
 * @property integer $bank_account_type_id
 *
 * The followings are the available model relations:
 * @property BankAccount[] $bankAccounts
 * @property BankAccountType $bankAccountType
 */
class BankInterest extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bank_interest';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bank_account_type_id', 'required'),
			array('bank_account_type_id', 'numerical', 'integerOnly'=>true),
			array('rate', 'length', 'max'=>11),
			array('name', 'length', 'max'=>32),
			array('create_date, modify_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, rate, name, create_date, modify_date, bank_account_type_id', 'safe', 'on'=>'search'),
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
			'bankAccounts' => array(self::HAS_MANY, 'BankAccount', 'bank_interest_id'),
			'bankAccountType' => array(self::BELONGS_TO, 'BankAccountType', 'bank_account_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'rate' => 'Rate',
			'name' => 'Name',
			'create_date' => 'Create Date',
			'modify_date' => 'Modify Date',
			'bank_account_type_id' => 'Bank Account Type',
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
		$criteria->compare('rate',$this->rate,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modify_date',$this->modify_date,true);
		$criteria->compare('bank_account_type_id',$this->bank_account_type_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BankInterest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
