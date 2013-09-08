<?php

/**
 * This is the model class for table "purchase_order_taxe".
 *
 * The followings are the available columns in table 'purchase_order_taxe':
 * @property integer $ord_id
 * @property integer $tax_id
 *
 * The followings are the available model relations:
 * @property AccountTax $tax
 * @property PurchaseOrderLine $ord
 */
class PurchaseOrderTaxe extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'purchase_order_taxe';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ord_id, tax_id', 'required'),
			array('ord_id, tax_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ord_id, tax_id', 'safe', 'on'=>'search'),
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
			'tax' => array(self::BELONGS_TO, 'AccountTax', 'tax_id'),
			'ord' => array(self::BELONGS_TO, 'PurchaseOrderLine', 'ord_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ord_id' => 'Ord',
			'tax_id' => 'Tax',
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

		$criteria->compare('ord_id',$this->ord_id);
		$criteria->compare('tax_id',$this->tax_id);

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
	 * @return PurchaseOrderTaxe the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
