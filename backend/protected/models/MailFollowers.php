<?php

/**
 * This is the model class for table "mail_followers".
 *
 * The followings are the available columns in table 'mail_followers':
 * @property integer $id
 * @property string $res_model
 * @property integer $res_id
 * @property integer $partner_id
 *
 * The followings are the available model relations:
 * @property ResPartner $partner
 * @property MailFollowersMailMessageSubtypeRel[] $mailFollowersMailMessageSubtypeRels
 */
class MailFollowers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mail_followers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('res_model, partner_id', 'required'),
			array('res_id, partner_id', 'numerical', 'integerOnly'=>true),
			array('res_model', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, res_model, res_id, partner_id', 'safe', 'on'=>'search'),
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
			'partner' => array(self::BELONGS_TO, 'ResPartner', 'partner_id'),
			'mailFollowersMailMessageSubtypeRels' => array(self::HAS_MANY, 'MailFollowersMailMessageSubtypeRel', 'mail_followers_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'res_model' => 'Res Model',
			'res_id' => 'Res',
			'partner_id' => 'Partner',
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
		$criteria->compare('res_model',$this->res_model,true);
		$criteria->compare('res_id',$this->res_id);
		$criteria->compare('partner_id',$this->partner_id);

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
	 * @return MailFollowers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
