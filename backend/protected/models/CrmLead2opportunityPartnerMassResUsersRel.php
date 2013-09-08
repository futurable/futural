<?php

/**
 * This is the model class for table "crm_lead2opportunity_partner_mass_res_users_rel".
 *
 * The followings are the available columns in table 'crm_lead2opportunity_partner_mass_res_users_rel':
 * @property integer $crm_lead2opportunity_partner_mass_id
 * @property integer $res_users_id
 *
 * The followings are the available model relations:
 * @property ResUsers $resUsers
 * @property CrmLead2opportunityPartnerMass $crmLead2opportunityPartnerMass
 */
class CrmLead2opportunityPartnerMassResUsersRel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'crm_lead2opportunity_partner_mass_res_users_rel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('crm_lead2opportunity_partner_mass_id, res_users_id', 'required'),
			array('crm_lead2opportunity_partner_mass_id, res_users_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('crm_lead2opportunity_partner_mass_id, res_users_id', 'safe', 'on'=>'search'),
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
			'resUsers' => array(self::BELONGS_TO, 'ResUsers', 'res_users_id'),
			'crmLead2opportunityPartnerMass' => array(self::BELONGS_TO, 'CrmLead2opportunityPartnerMass', 'crm_lead2opportunity_partner_mass_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'crm_lead2opportunity_partner_mass_id' => 'Crm Lead2opportunity Partner Mass',
			'res_users_id' => 'Res Users',
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

		$criteria->compare('crm_lead2opportunity_partner_mass_id',$this->crm_lead2opportunity_partner_mass_id);
		$criteria->compare('res_users_id',$this->res_users_id);

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
	 * @return CrmLead2opportunityPartnerMassResUsersRel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
