<?php

/**
 * This is the model class for table "stock_change_standard_price".
 *
 * The followings are the available columns in table 'stock_change_standard_price':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $stock_account_input
 * @property integer $stock_journal
 * @property boolean $enable_stock_in_out_acc
 * @property string $new_price
 * @property integer $stock_account_output
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property AccountJournal $stockJournal
 * @property AccountAccount $stockAccountOutput
 * @property AccountAccount $stockAccountInput
 * @property ResUsers $createU
 */
class StockChangeStandardPrice extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stock_change_standard_price';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('stock_journal, new_price', 'required'),
			array('create_uid, write_uid, stock_account_input, stock_journal, stock_account_output', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date, enable_stock_in_out_acc', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, stock_account_input, stock_journal, enable_stock_in_out_acc, new_price, stock_account_output', 'safe', 'on'=>'search'),
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
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'stockJournal' => array(self::BELONGS_TO, 'AccountJournal', 'stock_journal'),
			'stockAccountOutput' => array(self::BELONGS_TO, 'AccountAccount', 'stock_account_output'),
			'stockAccountInput' => array(self::BELONGS_TO, 'AccountAccount', 'stock_account_input'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
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
			'stock_account_input' => 'Stock Account Input',
			'stock_journal' => 'Stock Journal',
			'enable_stock_in_out_acc' => 'Enable Stock In Out Acc',
			'new_price' => 'New Price',
			'stock_account_output' => 'Stock Account Output',
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
		$criteria->compare('stock_account_input',$this->stock_account_input);
		$criteria->compare('stock_journal',$this->stock_journal);
		$criteria->compare('enable_stock_in_out_acc',$this->enable_stock_in_out_acc);
		$criteria->compare('new_price',$this->new_price,true);
		$criteria->compare('stock_account_output',$this->stock_account_output);

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
	 * @return StockChangeStandardPrice the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
