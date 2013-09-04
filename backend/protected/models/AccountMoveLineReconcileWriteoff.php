<?php

/**
 * This is the model class for table "account_move_line_reconcile_writeoff".
 *
 * The followings are the available columns in table 'account_move_line_reconcile_writeoff':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $comment
 * @property integer $analytic_id
 * @property integer $writeoff_acc_id
 * @property integer $journal_id
 * @property string $date_p
 *
 * The followings are the available model relations:
 * @property AccountAccount $writeoffAcc
 * @property ResUsers $writeU
 * @property AccountJournal $journal
 * @property ResUsers $createU
 * @property AccountAnalyticAccount $analytic
 */
class AccountMoveLineReconcileWriteoff extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_move_line_reconcile_writeoff';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comment, writeoff_acc_id, journal_id', 'required'),
			array('create_uid, write_uid, analytic_id, writeoff_acc_id, journal_id', 'numerical', 'integerOnly'=>true),
			array('comment', 'length', 'max'=>64),
			array('create_date, write_date, date_p', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, comment, analytic_id, writeoff_acc_id, journal_id, date_p', 'safe', 'on'=>'search'),
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
			'writeoffAcc' => array(self::BELONGS_TO, 'AccountAccount', 'writeoff_acc_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'journal' => array(self::BELONGS_TO, 'AccountJournal', 'journal_id'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'analytic' => array(self::BELONGS_TO, 'AccountAnalyticAccount', 'analytic_id'),
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
			'comment' => 'Comment',
			'analytic_id' => 'Analytic',
			'writeoff_acc_id' => 'Writeoff Acc',
			'journal_id' => 'Journal',
			'date_p' => 'Date P',
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
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('analytic_id',$this->analytic_id);
		$criteria->compare('writeoff_acc_id',$this->writeoff_acc_id);
		$criteria->compare('journal_id',$this->journal_id);
		$criteria->compare('date_p',$this->date_p,true);

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
	 * @return AccountMoveLineReconcileWriteoff the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
