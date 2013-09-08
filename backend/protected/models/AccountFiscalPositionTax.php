<?php

/**
 * This is the model class for table "account_fiscal_position_tax".
 *
 * The followings are the available columns in table 'account_fiscal_position_tax':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $position_id
 * @property integer $tax_dest_id
 * @property integer $tax_src_id
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property AccountTax $taxSrc
 * @property AccountTax $taxDest
 * @property AccountFiscalPosition $position
 * @property ResUsers $createU
 */
class AccountFiscalPositionTax extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account_fiscal_position_tax';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('position_id, tax_src_id', 'required'),
			array('create_uid, write_uid, position_id, tax_dest_id, tax_src_id', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, position_id, tax_dest_id, tax_src_id', 'safe', 'on'=>'search'),
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
			'taxSrc' => array(self::BELONGS_TO, 'AccountTax', 'tax_src_id'),
			'taxDest' => array(self::BELONGS_TO, 'AccountTax', 'tax_dest_id'),
			'position' => array(self::BELONGS_TO, 'AccountFiscalPosition', 'position_id'),
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
			'position_id' => 'Position',
			'tax_dest_id' => 'Tax Dest',
			'tax_src_id' => 'Tax Src',
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
		$criteria->compare('position_id',$this->position_id);
		$criteria->compare('tax_dest_id',$this->tax_dest_id);
		$criteria->compare('tax_src_id',$this->tax_src_id);

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
	 * @return AccountFiscalPositionTax the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
