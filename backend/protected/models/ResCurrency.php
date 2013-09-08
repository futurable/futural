<?php

/**
 * This is the model class for table "res_currency".
 *
 * The followings are the available columns in table 'res_currency':
 * @property integer $id
 * @property string $name
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $rounding
 * @property string $symbol
 * @property integer $company_id
 * @property string $date
 * @property boolean $base
 * @property boolean $active
 * @property string $position
 * @property integer $accuracy
 *
 * The followings are the available model relations:
 * @property AccountBankAccountsWizard[] $accountBankAccountsWizards
 * @property AccountChangeCurrency[] $accountChangeCurrencies
 * @property AccountMoveLine[] $accountMoveLines
 * @property AccountInvoice[] $accountInvoices
 * @property ResCurrencyRate[] $resCurrencyRates
 * @property AccountModelLine[] $accountModelLines
 * @property ProductPriceType[] $productPriceTypes
 * @property StockMove[] $stockMoves
 * @property ResCountry[] $resCountries
 * @property StockPartialPickingLine[] $stockPartialPickingLines
 * @property AccountJournal[] $accountJournals
 * @property ResCompany[] $resCompanies
 * @property AccountAccountTemplate[] $accountAccountTemplates
 * @property AccountVoucher[] $accountVouchers
 * @property AccountAccount[] $accountAccounts
 * @property ProductPricelist[] $productPricelists
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property WizardMultiChartsAccounts[] $wizardMultiChartsAccounts
 * @property StockPartialMoveLine[] $stockPartialMoveLines
 */
class ResCurrency extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'res_currency';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('create_uid, write_uid, company_id, accuracy', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>32),
			array('symbol', 'length', 'max'=>4),
			array('create_date, write_date, rounding, date, base, active, position', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, create_uid, create_date, write_date, write_uid, rounding, symbol, company_id, date, base, active, position, accuracy', 'safe', 'on'=>'search'),
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
			'accountBankAccountsWizards' => array(self::HAS_MANY, 'AccountBankAccountsWizard', 'currency_id'),
			'accountChangeCurrencies' => array(self::HAS_MANY, 'AccountChangeCurrency', 'currency_id'),
			'accountMoveLines' => array(self::HAS_MANY, 'AccountMoveLine', 'currency_id'),
			'accountInvoices' => array(self::HAS_MANY, 'AccountInvoice', 'currency_id'),
			'resCurrencyRates' => array(self::HAS_MANY, 'ResCurrencyRate', 'currency_id'),
			'accountModelLines' => array(self::HAS_MANY, 'AccountModelLine', 'currency_id'),
			'productPriceTypes' => array(self::HAS_MANY, 'ProductPriceType', 'currency_id'),
			'stockMoves' => array(self::HAS_MANY, 'StockMove', 'price_currency_id'),
			'resCountries' => array(self::HAS_MANY, 'ResCountry', 'currency_id'),
			'stockPartialPickingLines' => array(self::HAS_MANY, 'StockPartialPickingLine', 'currency'),
			'accountJournals' => array(self::HAS_MANY, 'AccountJournal', 'currency'),
			'resCompanies' => array(self::HAS_MANY, 'ResCompany', 'currency_id'),
			'accountAccountTemplates' => array(self::HAS_MANY, 'AccountAccountTemplate', 'currency_id'),
			'accountVouchers' => array(self::HAS_MANY, 'AccountVoucher', 'payment_rate_currency_id'),
			'accountAccounts' => array(self::HAS_MANY, 'AccountAccount', 'currency_id'),
			'productPricelists' => array(self::HAS_MANY, 'ProductPricelist', 'currency_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'wizardMultiChartsAccounts' => array(self::HAS_MANY, 'WizardMultiChartsAccounts', 'currency_id'),
			'stockPartialMoveLines' => array(self::HAS_MANY, 'StockPartialMoveLine', 'currency'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'rounding' => 'Rounding',
			'symbol' => 'Symbol',
			'company_id' => 'Company',
			'date' => 'Date',
			'base' => 'Base',
			'active' => 'Active',
			'position' => 'Position',
			'accuracy' => 'Accuracy',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('create_uid',$this->create_uid);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('write_date',$this->write_date,true);
		$criteria->compare('write_uid',$this->write_uid);
		$criteria->compare('rounding',$this->rounding,true);
		$criteria->compare('symbol',$this->symbol,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('base',$this->base);
		$criteria->compare('active',$this->active);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('accuracy',$this->accuracy);

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
	 * @return ResCurrency the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
