<?php

/**
 * This is the model class for table "ir_module_module".
 *
 * The followings are the available columns in table 'ir_module_module':
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $website
 * @property string $summary
 * @property string $name
 * @property string $author
 * @property string $url
 * @property string $state
 * @property string $latest_version
 * @property string $shortdesc
 * @property string $complexity
 * @property integer $category_id
 * @property string $description
 * @property boolean $application
 * @property boolean $demo
 * @property boolean $web
 * @property string $license
 * @property integer $sequence
 * @property boolean $auto_install
 * @property string $menus_by_module
 * @property string $maintainer
 * @property string $contributors
 * @property string $views_by_module
 * @property string $icon
 * @property string $reports_by_module
 * @property string $published_version
 *
 * The followings are the available model relations:
 * @property IrModelConstraint[] $irModelConstraints
 * @property IrModelRelation[] $irModelRelations
 * @property IrModuleModuleDependency[] $irModuleModuleDependencies
 * @property RelModulesLangexport[] $relModulesLangexports
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property IrModuleCategory $category
 */
class IrModuleModule extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ir_module_module';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('create_uid, write_uid, category_id, sequence', 'numerical', 'integerOnly'=>true),
			array('website, summary, shortdesc', 'length', 'max'=>256),
			array('name, author, url, maintainer, icon', 'length', 'max'=>128),
			array('state', 'length', 'max'=>16),
			array('latest_version, published_version', 'length', 'max'=>64),
			array('complexity, license', 'length', 'max'=>32),
			array('create_date, write_date, description, application, demo, web, auto_install, menus_by_module, contributors, views_by_module, reports_by_module', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_uid, create_date, write_date, write_uid, website, summary, name, author, url, state, latest_version, shortdesc, complexity, category_id, description, application, demo, web, license, sequence, auto_install, menus_by_module, maintainer, contributors, views_by_module, icon, reports_by_module, published_version', 'safe', 'on'=>'search'),
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
			'irModelConstraints' => array(self::HAS_MANY, 'IrModelConstraint', 'module'),
			'irModelRelations' => array(self::HAS_MANY, 'IrModelRelation', 'module'),
			'irModuleModuleDependencies' => array(self::HAS_MANY, 'IrModuleModuleDependency', 'module_id'),
			'relModulesLangexports' => array(self::HAS_MANY, 'RelModulesLangexport', 'module_id'),
			'writeU' => array(self::BELONGS_TO, 'ResUsers', 'write_uid'),
			'createU' => array(self::BELONGS_TO, 'ResUsers', 'create_uid'),
			'category' => array(self::BELONGS_TO, 'IrModuleCategory', 'category_id'),
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
			'website' => 'Website',
			'summary' => 'Summary',
			'name' => 'Name',
			'author' => 'Author',
			'url' => 'Url',
			'state' => 'State',
			'latest_version' => 'Latest Version',
			'shortdesc' => 'Shortdesc',
			'complexity' => 'Complexity',
			'category_id' => 'Category',
			'description' => 'Description',
			'application' => 'Application',
			'demo' => 'Demo',
			'web' => 'Web',
			'license' => 'License',
			'sequence' => 'Sequence',
			'auto_install' => 'Auto Install',
			'menus_by_module' => 'Menus By Module',
			'maintainer' => 'Maintainer',
			'contributors' => 'Contributors',
			'views_by_module' => 'Views By Module',
			'icon' => 'Icon',
			'reports_by_module' => 'Reports By Module',
			'published_version' => 'Published Version',
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
		$criteria->compare('website',$this->website,true);
		$criteria->compare('summary',$this->summary,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('latest_version',$this->latest_version,true);
		$criteria->compare('shortdesc',$this->shortdesc,true);
		$criteria->compare('complexity',$this->complexity,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('application',$this->application);
		$criteria->compare('demo',$this->demo);
		$criteria->compare('web',$this->web);
		$criteria->compare('license',$this->license,true);
		$criteria->compare('sequence',$this->sequence);
		$criteria->compare('auto_install',$this->auto_install);
		$criteria->compare('menus_by_module',$this->menus_by_module,true);
		$criteria->compare('maintainer',$this->maintainer,true);
		$criteria->compare('contributors',$this->contributors,true);
		$criteria->compare('views_by_module',$this->views_by_module,true);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('reports_by_module',$this->reports_by_module,true);
		$criteria->compare('published_version',$this->published_version,true);

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
	 * @return IrModuleModule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
