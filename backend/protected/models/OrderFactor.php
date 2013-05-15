<?php

/**
 * This is the model class for table "order_factor".
 *
 * The followings are the available columns in table 'order_factor':
 * @property integer $id
 * @property string $value
 * @property string $name
 * @property string $description
 * @property string $create_date
 * @property string $alter_date
 * @property integer $order_setup_id
 *
 * The followings are the available model relations:
 * @property OrderSetup $orderSetup
 */
class OrderFactor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_factor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, order_setup_id', 'required'),
			array('id, order_setup_id', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>3),
			array('name', 'length', 'max'=>32),
			array('description', 'length', 'max'=>256),
			array('create_date, alter_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, value, name, description, create_date, alter_date, order_setup_id', 'safe', 'on'=>'search'),
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
			'value' => 'Value',
			'name' => 'Name',
			'description' => 'Description',
			'create_date' => 'Create Date',
			'alter_date' => 'Alter Date',
			'order_setup_id' => 'Order Setup',
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
		$criteria->compare('value',$this->value,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('alter_date',$this->alter_date,true);
		$criteria->compare('order_setup_id',$this->order_setup_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderFactor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
