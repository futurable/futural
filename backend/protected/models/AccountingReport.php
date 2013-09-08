<?php

/**
 * This is the model class for table "accounting_report".
 *
 * The followings are the available columns in table 'accounting_report':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $period_to_cmp
 * @property integer $chart_account_id
 * @property integer $period_from_cmp
 * @property string $filter_cmp
 * @property boolean $enable_filter
 * @property integer $period_to
 * @property string $date_to_cmp
 * @property integer $fiscalyear_id
 * @property string $date_to
 * @property integer $account_report_id
 * @property integer $fiscalyear_id_cmp
 * @property string $date_from
 * @property string $filter
 * @property integer $period_from
 * @property string $label_filter
 * @property string $date_from_cmp
 * @property boolean $debit_credit
 * @property string $target_move
 *
 * The followings are the available model relations:
 * @property AccountJournalAccountingReportRel[] $accountJournalAccountingReportRels
 * @property ResUsers $writeU
 * @property AccountPeriod $periodTo
 * @property AccountPeriod $periodToCmp
 * @property AccountPeriod $periodFrom
 * @property AccountPeriod $periodFromCmp
 * @property AccountFiscalyear $fiscalyear
 * @property AccountFiscalyear $fiscalyearIdCmp
 * @property ResUsers $createU
 * @property AccountAccount $chartAccount
 * @property AccountFinancialReport $accountReport
 */
class AccountingReport extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'accounting_report';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('chart_account_id, filter_cmp, account_report_id, filter, target_move', 'required'),
			array('create_uid, write_uid, period_to_cmp, chart_account_id, period_from_cmp, period_to, fiscalyear_id, account_report_id, fiscalyear_id_cmp, period_from', 'numerical', 'integerOnly'=>true),
			array('label_filter', 'length', 'max'=>32),
			array('create_date, write_date, enable_filter, date_to_cmp, date_to, date_from, date_from_cmp, debit_credit', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, period_to_cmp, chart_account_id, period_from_cmp, filter_cmp, enable_filter, period_to, date_to_cmp, fiscalyear_id, date_to, account_report_id, fiscalyear_id_cmp, date_from, filter, period_from, label_filter, date_from_cmp, debit_credit, target_move', 'safe', 'on'=>'search'),
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
			'accountJournalAccountingReportRels' => array(self::HAS_MANY, 'AccountJournalAccountingReportRel', 'accounting_report_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'periodTo' => array(self::BELONGS_TO, 'AccountPeriod', 'period_to'),
			'periodToCmp' => array(self::BELONGS_TO, 'AccountPeriod', 'period_to_cmp'),
			'periodFrom' => array(self::BELONGS_TO, 'AccountPeriod', 'period_from'),
			'periodFromCmp' => array(self::BELONGS_TO, 'AccountPeriod', 'period_from_cmp'),
			'fiscalyear' => array(self::BELONGS_TO, 'AccountFiscalyear', 'fiscalyear_id'),
			'fiscalyearIdCmp' => array(self::BELONGS_TO, 'AccountFiscalyear', 'fiscalyear_id_cmp'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'chartAccount' => array(self::BELONGS_TO, 'AccountAccount', 'chart_account_id'),
			'accountReport' => array(self::BELONGS_TO, 'AccountFinancialReport', 'account_report_id'),
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
			'period_to_cmp' => 'Period To Cmp',
			'chart_account_id' => 'Chart Account',
			'period_from_cmp' => 'Period From Cmp',
			'filter_cmp' => 'Filter Cmp',
			'enable_filter' => 'Enable Filter',
			'period_to' => 'Period To',
			'date_to_cmp' => 'Date To Cmp',
			'fiscalyear_id' => 'Fiscalyear',
			'date_to' => 'Date To',
			'account_report_id' => 'Account Report',
			'fiscalyear_id_cmp' => 'Fiscalyear Id Cmp',
			'date_from' => 'Date From',
			'filter' => 'Filter',
			'period_from' => 'Period From',
			'label_filter' => 'Label Filter',
			'date_from_cmp' => 'Date From Cmp',
			'debit_credit' => 'Debit Credit',
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
		$criteria->compare('period_to_cmp',$this->period_to_cmp);
		$criteria->compare('chart_account_id',$this->chart_account_id);
		$criteria->compare('period_from_cmp',$this->period_from_cmp);
		$criteria->compare('filter_cmp',$this->filter_cmp,true);
		$criteria->compare('enable_filter',$this->enable_filter);
		$criteria->compare('period_to',$this->period_to);
		$criteria->compare('date_to_cmp',$this->date_to_cmp,true);
		$criteria->compare('fiscalyear_id',$this->fiscalyear_id);
		$criteria->compare('date_to',$this->date_to,true);
		$criteria->compare('account_report_id',$this->account_report_id);
		$criteria->compare('fiscalyear_id_cmp',$this->fiscalyear_id_cmp);
		$criteria->compare('date_from',$this->date_from,true);
		$criteria->compare('filter',$this->filter,true);
		$criteria->compare('period_from',$this->period_from);
		$criteria->compare('label_filter',$this->label_filter,true);
		$criteria->compare('date_from_cmp',$this->date_from_cmp,true);
		$criteria->compare('debit_credit',$this->debit_credit);
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
	 * @return AccountingReport the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
