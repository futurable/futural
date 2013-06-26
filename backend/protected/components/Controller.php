<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */

define('STUDENT', 0);
define('INSTRUCTOR', 1);
define('MANAGER', 2);
define('ADMIN', 3);

class Controller extends CController
{  
        public $userData; // Holds an activeRecord with current user. NULL if guest
    
        public function init() {
            // Load the user
            if (!Yii::app()->user->isGuest)
                $this->userData = User::model()->findByPk(Yii::app()->user->id);
        }
       
        public function allowUser($min_level) { //-1 no login required 0..3: admin level
            $current_level = 0;
            if ($this->userData !== null)
                $current_level = $this->userData->role;
            if ($min_level > $current_level) {
                throw new CHttpException(403, 'You have no permission to view this content');
            }
        }
        
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
}