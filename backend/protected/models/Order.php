<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property integer $id
 * @property string $created
 * @property string $event_time
 * @property string $executed
 * @property string $sent
 * @property integer $rows
 * @property string $value
 * @property integer $openerp_purchase_order_id
 * @property integer $company_id
 * @property integer $order_setup_id
 * @property integer $order_automation_id
 *
 * The followings are the available model relations:
 * @property Company $company
 * @property OrderAutomation $orderAutomation
 * @property OrderSetup $orderSetup
 */
class Order extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, order_setup_id, order_automation_id', 'required'),
			array('openerp_purchase_order_id, rows, openerp_purchase_order_id, company_id, order_setup_id, order_automation_id', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>19),
			array('created, event_time, executed, sent', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, created, event_time, executed, sent, rows, value, openerp_purchase_order_id, company_id, order_setup_id, order_automation_id', 'safe', 'on'=>'search'),
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
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
			'orderAutomation' => array(self::BELONGS_TO, 'OrderAutomation', 'order_automation_id'),
			'orderSetup' => array(self::BELONGS_TO, 'OrderSetup', 'order_setup_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created' => 'Created',
			'event_time' => 'Event Time',
			'executed' => 'Executed',
			'sent' => 'Sent',
			'rows' => 'Rows',
			'value' => 'Value',
			'openerp_purchase_order_id' => 'Openerp Purchase Order',
			'company_id' => 'Company',
			'order_setup_id' => 'Order Setup',
			'order_automation_id' => 'Order Automation',
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
		$criteria->compare('created',$this->created,true);
		$criteria->compare('event_time',$this->event_time,true);
		$criteria->compare('executed',$this->executed,true);
		$criteria->compare('sent',$this->sent,true);
		$criteria->compare('rows',$this->rows);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('openerp_purchase_order_id',$this->openerp_purchase_order_id);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('order_setup_id',$this->order_setup_id);
		$criteria->compare('order_automation_id',$this->order_automation_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
