<?php

/**
 * This is the model class for table "account_analytic_journal".
 *
 * The followings are the available columns in table 'account_analytic_journal':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $code
 * @property string $name
 * @property boolean $active
 * @property string $type
 * @property integer $company_id
 *
 * The followings are the available model relations:
 * @property AccountAnalyticLine[] $accountAnalyticLines
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property AccountAnalyticJournalName[] $accountAnalyticJournalNames
 * @property AnalyticProfitJournalRel[] $analyticProfitJournalRels
 * @property HrEmployee[] $hrEmployees
 * @property LedgerJournalRel[] $ledgerJournalRels
 * @property MrpWorkcenter[] $mrpWorkcenters
 * @property AccountJournal[] $accountJournals
 */
class AccountAnalyticJournal extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_analytic_journal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type, company_id', 'required'),
			array('create_uid, write_uid, company_id', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>8),
			array('name', 'length', 'max'=>64),
			array('type', 'length', 'max'=>32),
			array('create_date, write_date, active', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, code, name, active, type, company_id', 'safe', 'on'=>'search'),
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
			'accountAnalyticLines' => array(self::HAS_MANY, 'AccountAnalyticLine', 'journal_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'company' => array(self::BELONGS_TO, 'ResCompany', 'company_id'),
			'accountAnalyticJournalNames' => array(self::HAS_MANY, 'AccountAnalyticJournalName', 'journal_print_id'),
			'analyticProfitJournalRels' => array(self::HAS_MANY, 'AnalyticProfitJournalRel', 'journal_id'),
			'hrEmployees' => array(self::HAS_MANY, 'HrEmployee', 'journal_id'),
			'ledgerJournalRels' => array(self::HAS_MANY, 'LedgerJournalRel', 'journal_id'),
			'mrpWorkcenters' => array(self::HAS_MANY, 'MrpWorkcenter', 'costs_journal_id'),
			'accountJournals' => array(self::HAS_MANY, 'AccountJournal', 'analytic_journal_id'),
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
			'code' => 'Code',
			'name' => 'Name',
			'active' => 'Active',
			'type' => 'Type',
			'company_id' => 'Company',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('company_id',$this->company_id);

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
	 * @return AccountAnalyticJournal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
