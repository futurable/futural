<?php

/**
 * This is the model class for table "wizard_multi_charts_accounts".
 *
 * The followings are the available columns in table 'wizard_multi_charts_accounts':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property boolean $only_one_chart_template
 * @property double $purchase_tax_rate
 * @property boolean $complete_tax_set
 * @property integer $code_digits
 * @property integer $chart_template_id
 * @property integer $sale_tax
 * @property integer $company_id
 * @property integer $purchase_tax
 * @property integer $currency_id
 * @property double $sale_tax_rate
 *
 * The followings are the available model relations:
 * @property AccountBankAccountsWizard[] $accountBankAccountsWizards
 * @property ResUsers $writeU
 * @property AccountTaxTemplate $saleTax
 * @property AccountTaxTemplate $purchaseTax
 * @property ResCurrency $currency
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property AccountChartTemplate $chartTemplate
 */
class WizardMultiChartsAccounts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wizard_multi_charts_accounts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code_digits, chart_template_id, company_id', 'required'),
			array('create_uid, write_uid, code_digits, chart_template_id, sale_tax, company_id, purchase_tax, currency_id', 'numerical', 'integerOnly'=>true),
			array('purchase_tax_rate, sale_tax_rate', 'numerical'),
			array('create_date, write_date, only_one_chart_template, complete_tax_set', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, only_one_chart_template, purchase_tax_rate, complete_tax_set, code_digits, chart_template_id, sale_tax, company_id, purchase_tax, currency_id, sale_tax_rate', 'safe', 'on'=>'search'),
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
			'accountBankAccountsWizards' => array(self::HAS_MANY, 'AccountBankAccountsWizard', 'bank_account_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'saleTax' => array(self::BELONGS_TO, 'AccountTaxTemplate', 'sale_tax'),
			'purchaseTax' => array(self::BELONGS_TO, 'AccountTaxTemplate', 'purchase_tax'),
			'currency' => array(self::BELONGS_TO, 'ResCurrency', 'currency_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'chartTemplate' => array(self::BELONGS_TO, 'AccountChartTemplate', 'chart_template_id'),
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
			'only_one_chart_template' => 'Only One Chart Template',
			'purchase_tax_rate' => 'Purchase Tax Rate',
			'complete_tax_set' => 'Complete Tax Set',
			'code_digits' => 'Code Digits',
			'chart_template_id' => 'Chart Template',
			'sale_tax' => 'Sale Tax',
			'company_id' => 'Company',
			'purchase_tax' => 'Purchase Tax',
			'currency_id' => 'Currency',
			'sale_tax_rate' => 'Sale Tax Rate',
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
		$criteria->compare('only_one_chart_template',$this->only_one_chart_template);
		$criteria->compare('purchase_tax_rate',$this->purchase_tax_rate);
		$criteria->compare('complete_tax_set',$this->complete_tax_set);
		$criteria->compare('code_digits',$this->code_digits);
		$criteria->compare('chart_template_id',$this->chart_template_id);
		$criteria->compare('sale_tax',$this->sale_tax);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('purchase_tax',$this->purchase_tax);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('sale_tax_rate',$this->sale_tax_rate);

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
	 * @return WizardMultiChartsAccounts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
