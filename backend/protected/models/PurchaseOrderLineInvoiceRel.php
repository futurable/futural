<?php

/**
 * This is the model class for table "purchase_order_line_invoice_rel".
 *
 * The followings are the available columns in table 'purchase_order_line_invoice_rel':
 * @property integer $order_line_id
 * @property integer $invoice_id
 *
 * The followings are the available model relations:
 * @property PurchaseOrderLine $orderLine
 * @property AccountInvoiceLine $invoice
 */
class PurchaseOrderLineInvoiceRel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'purchase_order_line_invoice_rel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_line_id, invoice_id', 'required'),
			array('order_line_id, invoice_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('order_line_id, invoice_id', 'safe', 'on'=>'search'),
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
			'orderLine' => array(self::BELONGS_TO, 'PurchaseOrderLine', 'order_line_id'),
			'invoice' => array(self::BELONGS_TO, 'AccountInvoiceLine', 'invoice_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'order_line_id' => 'Order Line',
			'invoice_id' => 'Invoice',
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

		$criteria->compare('order_line_id',$this->order_line_id);
		$criteria->compare('invoice_id',$this->invoice_id);

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
	 * @return PurchaseOrderLineInvoiceRel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
