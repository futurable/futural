<?php

/**
 * This is the model class for table "account_chart_template".
 *
 * The followings are the available columns in table 'account_chart_template':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $property_account_expense_categ
 * @property integer $property_account_income_opening
 * @property integer $property_account_expense_opening
 * @property boolean $visible
 * @property integer $tax_code_root_id
 * @property integer $property_account_income_categ
 * @property integer $property_account_income
 * @property boolean $complete_tax_set
 * @property integer $code_digits
 * @property string $name
 * @property integer $property_account_expense
 * @property integer $property_account_receivable
 * @property integer $property_account_payable
 * @property integer $parent_id
 * @property integer $bank_account_view_id
 * @property integer $account_root_id
 *
 * The followings are the available model relations:
 * @property AccountConfigSettings[] $accountConfigSettings
 * @property ResUsers $writeU
 * @property AccountTaxCodeTemplate $taxCodeRoot
 * @property AccountAccountTemplate $propertyAccountReceivable
 * @property AccountAccountTemplate $propertyAccountPayable
 * @property AccountAccountTemplate $propertyAccountIncomeOpening
 * @property AccountAccountTemplate $propertyAccountIncome
 * @property AccountAccountTemplate $propertyAccountIncomeCateg
 * @property AccountAccountTemplate $propertyAccountExpenseOpening
 * @property AccountAccountTemplate $propertyAccountExpense
 * @property AccountAccountTemplate $propertyAccountExpenseCateg
 * @property AccountChartTemplate $parent
 * @property AccountChartTemplate[] $accountChartTemplates
 * @property ResUsers $createU
 * @property AccountAccountTemplate $bankAccountView
 * @property AccountAccountTemplate $accountRoot
 * @property AccountFiscalPositionTemplate[] $accountFiscalPositionTemplates
 * @property AccountAccountTemplate[] $accountAccountTemplates
 * @property AccountTaxTemplate[] $accountTaxTemplates
 * @property WizardMultiChartsAccounts[] $wizardMultiChartsAccounts
 */
class AccountChartTemplate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_chart_template';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code_digits, name', 'required'),
			array('create_uid, write_uid, property_account_expense_categ, property_account_income_opening, property_account_expense_opening, tax_code_root_id, property_account_income_categ, property_account_income, code_digits, property_account_expense, property_account_receivable, property_account_payable, parent_id, bank_account_view_id, account_root_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, visible, complete_tax_set', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, property_account_expense_categ, property_account_income_opening, property_account_expense_opening, visible, tax_code_root_id, property_account_income_categ, property_account_income, complete_tax_set, code_digits, name, property_account_expense, property_account_receivable, property_account_payable, parent_id, bank_account_view_id, account_root_id', 'safe', 'on'=>'search'),
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
			'accountConfigSettings' => array(self::HAS_MANY, 'AccountConfigSettings', 'chart_template_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'taxCodeRoot' => array(self::BELONGS_TO, 'AccountTaxCodeTemplate', 'tax_code_root_id'),
			'propertyAccountReceivable' => array(self::BELONGS_TO, 'AccountAccountTemplate', 'property_account_receivable'),
			'propertyAccountPayable' => array(self::BELONGS_TO, 'AccountAccountTemplate', 'property_account_payable'),
			'propertyAccountIncomeOpening' => array(self::BELONGS_TO, 'AccountAccountTemplate', 'property_account_income_opening'),
			'propertyAccountIncome' => array(self::BELONGS_TO, 'AccountAccountTemplate', 'property_account_income'),
			'propertyAccountIncomeCateg' => array(self::BELONGS_TO, 'AccountAccountTemplate', 'property_account_income_categ'),
			'propertyAccountExpenseOpening' => array(self::BELONGS_TO, 'AccountAccountTemplate', 'property_account_expense_opening'),
			'propertyAccountExpense' => array(self::BELONGS_TO, 'AccountAccountTemplate', 'property_account_expense'),
			'propertyAccountExpenseCateg' => array(self::BELONGS_TO, 'AccountAccountTemplate', 'property_account_expense_categ'),
			'parent' => array(self::BELONGS_TO, 'AccountChartTemplate', 'parent_id'),
			'accountChartTemplates' => array(self::HAS_MANY, 'AccountChartTemplate', 'parent_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'bankAccountView' => array(self::BELONGS_TO, 'AccountAccountTemplate', 'bank_account_view_id'),
			'accountRoot' => array(self::BELONGS_TO, 'AccountAccountTemplate', 'account_root_id'),
			'accountFiscalPositionTemplates' => array(self::HAS_MANY, 'AccountFiscalPositionTemplate', 'chart_template_id'),
			'accountAccountTemplates' => array(self::HAS_MANY, 'AccountAccountTemplate', 'chart_template_id'),
			'accountTaxTemplates' => array(self::HAS_MANY, 'AccountTaxTemplate', 'chart_template_id'),
			'wizardMultiChartsAccounts' => array(self::HAS_MANY, 'WizardMultiChartsAccounts', 'chart_template_id'),
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
			'property_account_expense_categ' => 'Property Account Expense Categ',
			'property_account_income_opening' => 'Property Account Income Opening',
			'property_account_expense_opening' => 'Property Account Expense Opening',
			'visible' => 'Visible',
			'tax_code_root_id' => 'Tax Code Root',
			'property_account_income_categ' => 'Property Account Income Categ',
			'property_account_income' => 'Property Account Income',
			'complete_tax_set' => 'Complete Tax Set',
			'code_digits' => 'Code Digits',
			'name' => 'Name',
			'property_account_expense' => 'Property Account Expense',
			'property_account_receivable' => 'Property Account Receivable',
			'property_account_payable' => 'Property Account Payable',
			'parent_id' => 'Parent',
			'bank_account_view_id' => 'Bank Account View',
			'account_root_id' => 'Account Root',
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
		$criteria->compare('property_account_expense_categ',$this->property_account_expense_categ);
		$criteria->compare('property_account_income_opening',$this->property_account_income_opening);
		$criteria->compare('property_account_expense_opening',$this->property_account_expense_opening);
		$criteria->compare('visible',$this->visible);
		$criteria->compare('tax_code_root_id',$this->tax_code_root_id);
		$criteria->compare('property_account_income_categ',$this->property_account_income_categ);
		$criteria->compare('property_account_income',$this->property_account_income);
		$criteria->compare('complete_tax_set',$this->complete_tax_set);
		$criteria->compare('code_digits',$this->code_digits);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('property_account_expense',$this->property_account_expense);
		$criteria->compare('property_account_receivable',$this->property_account_receivable);
		$criteria->compare('property_account_payable',$this->property_account_payable);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('bank_account_view_id',$this->bank_account_view_id);
		$criteria->compare('account_root_id',$this->account_root_id);

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
	 * @return AccountChartTemplate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
