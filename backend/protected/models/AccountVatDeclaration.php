<?php

/**
 * This is the model class for table "account_vat_declaration".
 *
 * The followings are the available columns in table 'account_vat_declaration':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $chart_account_id
 * @property string $date_from
 * @property string $date_to
 * @property integer $period_to
 * @property string $filter
 * @property integer $period_from
 * @property integer $fiscalyear_id
 * @property string $based_on
 * @property boolean $display_detail
 * @property integer $chart_tax_id
 * @property string $target_move
 *
 * The followings are the available model relations:
 * @property AccountJournalAccountVatDeclarationRel[] $accountJournalAccountVatDeclarationRels
 * @property ResUsers $writeU
 * @property AccountPeriod $periodTo
 * @property AccountPeriod $periodFrom
 * @property AccountFiscalyear $fiscalyear
 * @property ResUsers $createU
 * @property AccountTaxCode $chartTax
 * @property AccountAccount $chartAccount
 */
class AccountVatDeclaration extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_vat_declaration';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('chart_account_id, filter, based_on, chart_tax_id, target_move', 'required'),
			array('create_uid, write_uid, chart_account_id, period_to, period_from, fiscalyear_id, chart_tax_id', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date, date_from, date_to, display_detail', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, chart_account_id, date_from, date_to, period_to, filter, period_from, fiscalyear_id, based_on, display_detail, chart_tax_id, target_move', 'safe', 'on'=>'search'),
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
			'accountJournalAccountVatDeclarationRels' => array(self::HAS_MANY, 'AccountJournalAccountVatDeclarationRel', 'account_vat_declaration_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'periodTo' => array(self::BELONGS_TO, 'AccountPeriod', 'period_to'),
			'periodFrom' => array(self::BELONGS_TO, 'AccountPeriod', 'period_from'),
			'fiscalyear' => array(self::BELONGS_TO, 'AccountFiscalyear', 'fiscalyear_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'chartTax' => array(self::BELONGS_TO, 'AccountTaxCode', 'chart_tax_id'),
			'chartAccount' => array(self::BELONGS_TO, 'AccountAccount', 'chart_account_id'),
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
			'chart_account_id' => 'Chart Account',
			'date_from' => 'Date From',
			'date_to' => 'Date To',
			'period_to' => 'Period To',
			'filter' => 'Filter',
			'period_from' => 'Period From',
			'fiscalyear_id' => 'Fiscalyear',
			'based_on' => 'Based On',
			'display_detail' => 'Display Detail',
			'chart_tax_id' => 'Chart Tax',
			'target_move' => 'Target Move',
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
		$criteria->compare('chart_account_id',$this->chart_account_id);
		$criteria->compare('date_from',$this->date_from,true);
		$criteria->compare('date_to',$this->date_to,true);
		$criteria->compare('period_to',$this->period_to);
		$criteria->compare('filter',$this->filter,true);
		$criteria->compare('period_from',$this->period_from);
		$criteria->compare('fiscalyear_id',$this->fiscalyear_id);
		$criteria->compare('based_on',$this->based_on,true);
		$criteria->compare('display_detail',$this->display_detail);
		$criteria->compare('chart_tax_id',$this->chart_tax_id);
		$criteria->compare('target_move',$this->target_move,true);

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
	 * @return AccountVatDeclaration the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
