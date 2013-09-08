<?php

/**
 * This is the model class for table "account_tax_code".
 *
 * The followings are the available columns in table 'account_tax_code':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $info
 * @property string $code
 * @property string $name
 * @property integer $sequence
 * @property integer $company_id
 * @property double $sign
 * @property boolean $notprintable
 * @property integer $parent_id
 *
 * The followings are the available model relations:
 * @property AccountMoveLine[] $accountMoveLines
 * @property AccountInvoiceTax[] $accountInvoiceTaxes
 * @property AccountInvoiceTax[] $accountInvoiceTaxes1
 * @property ResUsers $writeU
 * @property AccountTaxCode $parent
 * @property AccountTaxCode[] $accountTaxCodes
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property AccountVatDeclaration[] $accountVatDeclarations
 * @property AccountTax[] $accountTaxes
 * @property AccountTax[] $accountTaxes1
 * @property AccountTax[] $accountTaxes2
 * @property AccountTax[] $accountTaxes3
 */
class AccountTaxCode extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_tax_code';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, company_id, sign', 'required'),
			array('create_uid, write_uid, sequence, company_id, parent_id', 'numerical', 'integerOnly'=>true),
			array('sign', 'numerical'),
			array('code, name', 'length', 'max'=>64),
			array('create_date, write_date, info, notprintable', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, info, code, name, sequence, company_id, sign, notprintable, parent_id', 'safe', 'on'=>'search'),
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
			'accountMoveLines' => array(self::HAS_MANY, 'AccountMoveLine', 'tax_code_id'),
			'accountInvoiceTaxes' => array(self::HAS_MANY, 'AccountInvoiceTax', 'tax_code_id'),
			'accountInvoiceTaxes1' => array(self::HAS_MANY, 'AccountInvoiceTax', 'base_code_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'parent' => array(self::BELONGS_TO, 'AccountTaxCode', 'parent_id'),
			'accountTaxCodes' => array(self::HAS_MANY, 'AccountTaxCode', 'parent_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'accountVatDeclarations' => array(self::HAS_MANY, 'AccountVatDeclaration', 'chart_tax_id'),
			'accountTaxes' => array(self::HAS_MANY, 'AccountTax', 'tax_code_id'),
			'accountTaxes1' => array(self::HAS_MANY, 'AccountTax', 'ref_tax_code_id'),
			'accountTaxes2' => array(self::HAS_MANY, 'AccountTax', 'ref_base_code_id'),
			'accountTaxes3' => array(self::HAS_MANY, 'AccountTax', 'base_code_id'),
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
			'info' => 'Info',
			'code' => 'Code',
			'name' => 'Name',
			'sequence' => 'Sequence',
			'company_id' => 'Company',
			'sign' => 'Sign',
			'notprintable' => 'Notprintable',
			'parent_id' => 'Parent',
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
		$criteria->compare('info',$this->info,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('sign',$this->sign);
		$criteria->compare('notprintable',$this->notprintable);
		$criteria->compare('parent_id',$this->parent_id);

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
	 * @return AccountTaxCode the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
