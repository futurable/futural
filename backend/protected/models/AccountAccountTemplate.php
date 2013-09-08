<?php

/**
 * This is the model class for table "account_account_template".
 *
 * The followings are the available columns in table 'account_account_template':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $note
 * @property string $code
 * @property boolean $reconcile
 * @property integer $user_type
 * @property string $shortcut
 * @property integer $currency_id
 * @property integer $parent_id
 * @property boolean $nocreate
 * @property string $type
 * @property integer $chart_template_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property AccountAccountTemplateTaxRel[] $accountAccountTemplateTaxRels
 * @property AccountChartTemplate[] $accountChartTemplates
 * @property AccountChartTemplate[] $accountChartTemplates1
 * @property AccountChartTemplate[] $accountChartTemplates2
 * @property AccountChartTemplate[] $accountChartTemplates3
 * @property AccountChartTemplate[] $accountChartTemplates4
 * @property AccountChartTemplate[] $accountChartTemplates5
 * @property AccountChartTemplate[] $accountChartTemplates6
 * @property AccountChartTemplate[] $accountChartTemplates7
 * @property AccountChartTemplate[] $accountChartTemplates8
 * @property AccountChartTemplate[] $accountChartTemplates9
 * @property AccountTemplateFinancialReport[] $accountTemplateFinancialReports
 * @property AccountFiscalPositionAccountTemplate[] $accountFiscalPositionAccountTemplates
 * @property AccountFiscalPositionAccountTemplate[] $accountFiscalPositionAccountTemplates1
 * @property ResUsers $writeU
 * @property AccountAccountType $userType
 * @property AccountAccountTemplate $parent
 * @property AccountAccountTemplate[] $accountAccountTemplates
 * @property ResCurrency $currency
 * @property ResUsers $createU
 * @property AccountChartTemplate $chartTemplate
 * @property AccountTaxTemplate[] $accountTaxTemplates
 * @property AccountTaxTemplate[] $accountTaxTemplates1
 */
class AccountAccountTemplate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_account_template';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, user_type, type, name', 'required'),
			array('create_uid, write_uid, user_type, currency_id, parent_id, chart_template_id', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>64),
			array('shortcut', 'length', 'max'=>12),
			array('name', 'length', 'max'=>256),
			array('create_date, write_date, note, reconcile, nocreate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, note, code, reconcile, user_type, shortcut, currency_id, parent_id, nocreate, type, chart_template_id, name', 'safe', 'on'=>'search'),
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
			'accountAccountTemplateTaxRels' => array(self::HAS_MANY, 'AccountAccountTemplateTaxRel', 'account_id'),
			'accountChartTemplates' => array(self::HAS_MANY, 'AccountChartTemplate', 'property_account_receivable'),
			'accountChartTemplates1' => array(self::HAS_MANY, 'AccountChartTemplate', 'property_account_payable'),
			'accountChartTemplates2' => array(self::HAS_MANY, 'AccountChartTemplate', 'property_account_income_opening'),
			'accountChartTemplates3' => array(self::HAS_MANY, 'AccountChartTemplate', 'property_account_income'),
			'accountChartTemplates4' => array(self::HAS_MANY, 'AccountChartTemplate', 'property_account_income_categ'),
			'accountChartTemplates5' => array(self::HAS_MANY, 'AccountChartTemplate', 'property_account_expense_opening'),
			'accountChartTemplates6' => array(self::HAS_MANY, 'AccountChartTemplate', 'property_account_expense'),
			'accountChartTemplates7' => array(self::HAS_MANY, 'AccountChartTemplate', 'property_account_expense_categ'),
			'accountChartTemplates8' => array(self::HAS_MANY, 'AccountChartTemplate', 'bank_account_view_id'),
			'accountChartTemplates9' => array(self::HAS_MANY, 'AccountChartTemplate', 'account_root_id'),
			'accountTemplateFinancialReports' => array(self::HAS_MANY, 'AccountTemplateFinancialReport', 'account_template_id'),
			'accountFiscalPositionAccountTemplates' => array(self::HAS_MANY, 'AccountFiscalPositionAccountTemplate', 'account_src_id'),
			'accountFiscalPositionAccountTemplates1' => array(self::HAS_MANY, 'AccountFiscalPositionAccountTemplate', 'account_dest_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'userType' => array(self::BELONGS_TO, 'AccountAccountType', 'user_type'),
			'parent' => array(self::BELONGS_TO, 'AccountAccountTemplate', 'parent_id'),
			'accountAccountTemplates' => array(self::HAS_MANY, 'AccountAccountTemplate', 'parent_id'),
			'currency' => array(self::BELONGS_TO, 'ResCurrency', 'currency_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'chartTemplate' => array(self::BELONGS_TO, 'AccountChartTemplate', 'chart_template_id'),
			'accountTaxTemplates' => array(self::HAS_MANY, 'AccountTaxTemplate', 'account_paid_id'),
			'accountTaxTemplates1' => array(self::HAS_MANY, 'AccountTaxTemplate', 'account_collected_id'),
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
			'note' => 'Note',
			'code' => 'Code',
			'reconcile' => 'Reconcile',
			'user_type' => 'User Type',
			'shortcut' => 'Shortcut',
			'currency_id' => 'Currency',
			'parent_id' => 'Parent',
			'nocreate' => 'Nocreate',
			'type' => 'Type',
			'chart_template_id' => 'Chart Template',
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
		$criteria->compare('note',$this->note,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('reconcile',$this->reconcile);
		$criteria->compare('user_type',$this->user_type);
		$criteria->compare('shortcut',$this->shortcut,true);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('nocreate',$this->nocreate);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('chart_template_id',$this->chart_template_id);
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
	 * @return AccountAccountTemplate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
