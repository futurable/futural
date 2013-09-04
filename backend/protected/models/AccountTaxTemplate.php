<?php

/**
 * This is the model class for table "account_tax_template".
 *
 * The followings are the available columns in table 'account_tax_template':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $ref_base_code_id
 * @property string $domain
 * @property string $description
 * @property integer $ref_tax_code_id
 * @property integer $sequence
 * @property double $ref_base_sign
 * @property string $type_tax_use
 * @property integer $base_code_id
 * @property double $base_sign
 * @property boolean $child_depend
 * @property boolean $include_base_amount
 * @property string $applicable_type
 * @property double $ref_tax_sign
 * @property integer $account_paid_id
 * @property integer $account_collected_id
 * @property integer $chart_template_id
 * @property string $name
 * @property integer $tax_code_id
 * @property integer $parent_id
 * @property string $amount
 * @property string $python_compute
 * @property double $tax_sign
 * @property string $python_compute_inv
 * @property string $python_applicable
 * @property string $type
 * @property boolean $price_include
 *
 * The followings are the available model relations:
 * @property AccountAccountTemplateTaxRel[] $accountAccountTemplateTaxRels
 * @property AccountConfigSettings[] $accountConfigSettings
 * @property AccountConfigSettings[] $accountConfigSettings1
 * @property AccountFiscalPositionTaxTemplate[] $accountFiscalPositionTaxTemplates
 * @property AccountFiscalPositionTaxTemplate[] $accountFiscalPositionTaxTemplates1
 * @property ResUsers $writeU
 * @property AccountTaxCodeTemplate $taxCode
 * @property AccountTaxCodeTemplate $refTaxCode
 * @property AccountTaxCodeTemplate $refBaseCode
 * @property AccountTaxTemplate $parent
 * @property AccountTaxTemplate[] $accountTaxTemplates
 * @property ResUsers $createU
 * @property AccountChartTemplate $chartTemplate
 * @property AccountTaxCodeTemplate $baseCode
 * @property AccountAccountTemplate $accountPaid
 * @property AccountAccountTemplate $accountCollected
 * @property WizardMultiChartsAccounts[] $wizardMultiChartsAccounts
 * @property WizardMultiChartsAccounts[] $wizardMultiChartsAccounts1
 */
class AccountTaxTemplate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_tax_template';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sequence, type_tax_use, applicable_type, chart_template_id, name, amount, type', 'required'),
			array('create_uid, write_uid, ref_base_code_id, ref_tax_code_id, sequence, base_code_id, account_paid_id, account_collected_id, chart_template_id, tax_code_id, parent_id', 'numerical', 'integerOnly'=>true),
			array('ref_base_sign, base_sign, ref_tax_sign, tax_sign', 'numerical'),
			array('domain', 'length', 'max'=>32),
			array('name', 'length', 'max'=>64),
			array('create_date, write_date, description, child_depend, include_base_amount, python_compute, python_compute_inv, python_applicable, price_include', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, ref_base_code_id, domain, description, ref_tax_code_id, sequence, ref_base_sign, type_tax_use, base_code_id, base_sign, child_depend, include_base_amount, applicable_type, ref_tax_sign, account_paid_id, account_collected_id, chart_template_id, name, tax_code_id, parent_id, amount, python_compute, tax_sign, python_compute_inv, python_applicable, type, price_include', 'safe', 'on'=>'search'),
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
			'accountAccountTemplateTaxRels' => array(self::HAS_MANY, 'AccountAccountTemplateTaxRel', 'tax_id'),
			'accountConfigSettings' => array(self::HAS_MANY, 'AccountConfigSettings', 'sale_tax'),
			'accountConfigSettings1' => array(self::HAS_MANY, 'AccountConfigSettings', 'purchase_tax'),
			'accountFiscalPositionTaxTemplates' => array(self::HAS_MANY, 'AccountFiscalPositionTaxTemplate', 'tax_src_id'),
			'accountFiscalPositionTaxTemplates1' => array(self::HAS_MANY, 'AccountFiscalPositionTaxTemplate', 'tax_dest_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'taxCode' => array(self::BELONGS_TO, 'AccountTaxCodeTemplate', 'tax_code_id'),
			'refTaxCode' => array(self::BELONGS_TO, 'AccountTaxCodeTemplate', 'ref_tax_code_id'),
			'refBaseCode' => array(self::BELONGS_TO, 'AccountTaxCodeTemplate', 'ref_base_code_id'),
			'parent' => array(self::BELONGS_TO, 'AccountTaxTemplate', 'parent_id'),
			'accountTaxTemplates' => array(self::HAS_MANY, 'AccountTaxTemplate', 'parent_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'chartTemplate' => array(self::BELONGS_TO, 'AccountChartTemplate', 'chart_template_id'),
			'baseCode' => array(self::BELONGS_TO, 'AccountTaxCodeTemplate', 'base_code_id'),
			'accountPaid' => array(self::BELONGS_TO, 'AccountAccountTemplate', 'account_paid_id'),
			'accountCollected' => array(self::BELONGS_TO, 'AccountAccountTemplate', 'account_collected_id'),
			'wizardMultiChartsAccounts' => array(self::HAS_MANY, 'WizardMultiChartsAccounts', 'sale_tax'),
			'wizardMultiChartsAccounts1' => array(self::HAS_MANY, 'WizardMultiChartsAccounts', 'purchase_tax'),
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
			'ref_base_code_id' => 'Ref Base Code',
			'domain' => 'Domain',
			'description' => 'Description',
			'ref_tax_code_id' => 'Ref Tax Code',
			'sequence' => 'Sequence',
			'ref_base_sign' => 'Ref Base Sign',
			'type_tax_use' => 'Type Tax Use',
			'base_code_id' => 'Base Code',
			'base_sign' => 'Base Sign',
			'child_depend' => 'Child Depend',
			'include_base_amount' => 'Include Base Amount',
			'applicable_type' => 'Applicable Type',
			'ref_tax_sign' => 'Ref Tax Sign',
			'account_paid_id' => 'Account Paid',
			'account_collected_id' => 'Account Collected',
			'chart_template_id' => 'Chart Template',
			'name' => 'Name',
			'tax_code_id' => 'Tax Code',
			'parent_id' => 'Parent',
			'amount' => 'Amount',
			'python_compute' => 'Python Compute',
			'tax_sign' => 'Tax Sign',
			'python_compute_inv' => 'Python Compute Inv',
			'python_applicable' => 'Python Applicable',
			'type' => 'Type',
			'price_include' => 'Price Include',
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
		$criteria->compare('ref_base_code_id',$this->ref_base_code_id);
		$criteria->compare('domain',$this->domain,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('ref_tax_code_id',$this->ref_tax_code_id);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('ref_base_sign',$this->ref_base_sign);
		$criteria->compare('type_tax_use',$this->type_tax_use,true);
		$criteria->compare('base_code_id',$this->base_code_id);
		$criteria->compare('base_sign',$this->base_sign);
		$criteria->compare('child_depend',$this->child_depend);
		$criteria->compare('include_base_amount',$this->include_base_amount);
		$criteria->compare('applicable_type',$this->applicable_type,true);
		$criteria->compare('ref_tax_sign',$this->ref_tax_sign);
		$criteria->compare('account_paid_id',$this->account_paid_id);
		$criteria->compare('account_collected_id',$this->account_collected_id);
		$criteria->compare('chart_template_id',$this->chart_template_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('tax_code_id',$this->tax_code_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('python_compute',$this->python_compute,true);
		$criteria->compare('tax_sign',$this->tax_sign);
		$criteria->compare('python_compute_inv',$this->python_compute_inv,true);
		$criteria->compare('python_applicable',$this->python_applicable,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('price_include',$this->price_include);

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
	 * @return AccountTaxTemplate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
