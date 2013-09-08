<?php

/**
 * This is the model class for table "account_common_report_account_journal_rel".
 *
 * The followings are the available columns in table 'account_common_report_account_journal_rel':
 * @property integer $account_common_report_id
 * @property integer $account_journal_id
 *
 * The followings are the available model relations:
 * @property AccountJournal $accountJournal
 * @property AccountCommonReport $accountCommonReport
 */
class AccountCommonReportAccountJournalRel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_common_report_account_journal_rel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_common_report_id, account_journal_id', 'required'),
			array('account_common_report_id, account_journal_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('account_common_report_id, account_journal_id', 'safe', 'on'=>'search'),
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
			'accountJournal' => array(self::BELONGS_TO, 'AccountJournal', 'account_journal_id'),
			'accountCommonReport' => array(self::BELONGS_TO, 'AccountCommonReport', 'account_common_report_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'account_common_report_id' => 'Account Common Report',
			'account_journal_id' => 'Account Journal',
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

		$criteria->compare('account_common_report_id',$this->account_common_report_id);
		$criteria->compare('account_journal_id',$this->account_journal_id);

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
	 * @return AccountCommonReportAccountJournalRel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
