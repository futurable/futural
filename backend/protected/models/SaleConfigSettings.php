<?php

/**
 * This is the model class for table "sale_config_settings".
 *
 * The followings are the available columns in table 'sale_config_settings':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property boolean $module_sale
 * @property boolean $module_plugin_outlook
 * @property boolean $module_web_linkedin
 * @property boolean $module_plugin_thunderbird
 * @property boolean $module_crm
 * @property boolean $group_sale_pricelist
 * @property boolean $group_discount_per_so_line
 * @property boolean $timesheet
 * @property boolean $group_invoice_so_lines
 * @property boolean $module_sale_stock
 * @property integer $time_unit
 * @property boolean $module_account_analytic_analysis
 * @property boolean $group_uom
 * @property boolean $module_project
 * @property boolean $module_analytic_user_function
 * @property boolean $module_sale_journal
 * @property boolean $module_warning
 * @property boolean $module_sale_margin
 * @property boolean $module_delivery
 * @property boolean $group_invoice_deli_orders
 * @property boolean $default_picking_policy
 * @property boolean $task_work
 * @property boolean $group_mrp_properties
 * @property boolean $group_sale_delivery_address
 * @property boolean $group_multiple_shops
 * @property string $default_order_policy
 * @property boolean $module_project_mrp
 * @property boolean $module_project_timesheet
 * @property boolean $fetchmail_lead
 * @property boolean $module_crm_claim
 * @property boolean $group_fund_raising
 * @property boolean $module_crm_helpdesk
 * @property boolean $group_template_required
 *
 * The followings are the available model relations:
 * @property ResUsers $writeU
 * @property ProductUom $timeUnit
 * @property ResUsers $createU
 */
class SaleConfigSettings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sale_config_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_uid, write_uid, time_unit', 'numerical', 'integerOnly'=>true),
			array('create_date, write_date, module_sale, module_plugin_outlook, module_web_linkedin, module_plugin_thunderbird, module_crm, group_sale_pricelist, group_discount_per_so_line, timesheet, group_invoice_so_lines, module_sale_stock, module_account_analytic_analysis, group_uom, module_project, module_analytic_user_function, module_sale_journal, module_warning, module_sale_margin, module_delivery, group_invoice_deli_orders, default_picking_policy, task_work, group_mrp_properties, group_sale_delivery_address, group_multiple_shops, default_order_policy, module_project_mrp, module_project_timesheet, fetchmail_lead, module_crm_claim, group_fund_raising, module_crm_helpdesk, group_template_required', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, module_sale, module_plugin_outlook, module_web_linkedin, module_plugin_thunderbird, module_crm, group_sale_pricelist, group_discount_per_so_line, timesheet, group_invoice_so_lines, module_sale_stock, time_unit, module_account_analytic_analysis, group_uom, module_project, module_analytic_user_function, module_sale_journal, module_warning, module_sale_margin, module_delivery, group_invoice_deli_orders, default_picking_policy, task_work, group_mrp_properties, group_sale_delivery_address, group_multiple_shops, default_order_policy, module_project_mrp, module_project_timesheet, fetchmail_lead, module_crm_claim, group_fund_raising, module_crm_helpdesk, group_template_required', 'safe', 'on'=>'search'),
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
			'timeUnit' => array(self::BELONGS_TO, 'ProductUom', 'time_unit'),
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
			'module_sale' => 'Module Sale',
			'module_plugin_outlook' => 'Module Plugin Outlook',
			'module_web_linkedin' => 'Module Web Linkedin',
			'module_plugin_thunderbird' => 'Module Plugin Thunderbird',
			'module_crm' => 'Module Crm',
			'group_sale_pricelist' => 'Group Sale Pricelist',
			'group_discount_per_so_line' => 'Group Discount Per So Line',
			'timesheet' => 'Timesheet',
			'group_invoice_so_lines' => 'Group Invoice So Lines',
			'module_sale_stock' => 'Module Sale Stock',
			'time_unit' => 'Time Unit',
			'module_account_analytic_analysis' => 'Module Account Analytic Analysis',
			'group_uom' => 'Group Uom',
			'module_project' => 'Module Project',
			'module_analytic_user_function' => 'Module Analytic User Function',
			'module_sale_journal' => 'Module Sale Journal',
			'module_warning' => 'Module Warning',
			'module_sale_margin' => 'Module Sale Margin',
			'module_delivery' => 'Module Delivery',
			'group_invoice_deli_orders' => 'Group Invoice Deli Orders',
			'default_picking_policy' => 'Default Picking Policy',
			'task_work' => 'Task Work',
			'group_mrp_properties' => 'Group Mrp Properties',
			'group_sale_delivery_address' => 'Group Sale Delivery Address',
			'group_multiple_shops' => 'Group Multiple Shops',
			'default_order_policy' => 'Default Order Policy',
			'module_project_mrp' => 'Module Project Mrp',
			'module_project_timesheet' => 'Module Project Timesheet',
			'fetchmail_lead' => 'Fetchmail Lead',
			'module_crm_claim' => 'Module Crm Claim',
			'group_fund_raising' => 'Group Fund Raising',
			'module_crm_helpdesk' => 'Module Crm Helpdesk',
			'group_template_required' => 'Group Template Required',
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
		$criteria->compare('module_sale',$this->module_sale);
		$criteria->compare('module_plugin_outlook',$this->module_plugin_outlook);
		$criteria->compare('module_web_linkedin',$this->module_web_linkedin);
		$criteria->compare('module_plugin_thunderbird',$this->module_plugin_thunderbird);
		$criteria->compare('module_crm',$this->module_crm);
		$criteria->compare('group_sale_pricelist',$this->group_sale_pricelist);
		$criteria->compare('group_discount_per_so_line',$this->group_discount_per_so_line);
		$criteria->compare('timesheet',$this->timesheet);
		$criteria->compare('group_invoice_so_lines',$this->group_invoice_so_lines);
		$criteria->compare('module_sale_stock',$this->module_sale_stock);
		$criteria->compare('time_unit',$this->time_unit);
		$criteria->compare('module_account_analytic_analysis',$this->module_account_analytic_analysis);
		$criteria->compare('group_uom',$this->group_uom);
		$criteria->compare('module_project',$this->module_project);
		$criteria->compare('module_analytic_user_function',$this->module_analytic_user_function);
		$criteria->compare('module_sale_journal',$this->module_sale_journal);
		$criteria->compare('module_warning',$this->module_warning);
		$criteria->compare('module_sale_margin',$this->module_sale_margin);
		$criteria->compare('module_delivery',$this->module_delivery);
		$criteria->compare('group_invoice_deli_orders',$this->group_invoice_deli_orders);
		$criteria->compare('default_picking_policy',$this->default_picking_policy);
		$criteria->compare('task_work',$this->task_work);
		$criteria->compare('group_mrp_properties',$this->group_mrp_properties);
		$criteria->compare('group_sale_delivery_address',$this->group_sale_delivery_address);
		$criteria->compare('group_multiple_shops',$this->group_multiple_shops);
		$criteria->compare('default_order_policy',$this->default_order_policy,true);
		$criteria->compare('module_project_mrp',$this->module_project_mrp);
		$criteria->compare('module_project_timesheet',$this->module_project_timesheet);
		$criteria->compare('fetchmail_lead',$this->fetchmail_lead);
		$criteria->compare('module_crm_claim',$this->module_crm_claim);
		$criteria->compare('group_fund_raising',$this->group_fund_raising);
		$criteria->compare('module_crm_helpdesk',$this->module_crm_helpdesk);
		$criteria->compare('group_template_required',$this->group_template_required);

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
	 * @return SaleConfigSettings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
