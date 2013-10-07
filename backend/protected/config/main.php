<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'The Futural backend',
        'sourceLanguage'=>'00',
        'language'=>'fi',

	// preloading 'log' component
	'preload'=>array('log', 'bootstrap'),

	// autoloading model and component classes
	'import'=>array(
        'application.models.*',
        'application.components.*',
        'ext.mail.YiiMailMessage',
	),

	'modules'=>array(
            // uncomment the following to enable the Gii tool
            'gii'=>array(
                'class'=>'system.gii.GiiModule',
                'password'=>'futural',
                // If removed, Gii defaults to localhost only. Edit carefully to taste.
                'ipFilters'=>array('127.0.0.1','::1'),
            ),
            'generatorPaths' => array(
                'bootstrap.gii'
            ),
	),

	// application components
	'components'=>array(
            'user'=>array(
                // enable cookie-based authentication
                'class'=>'WebUser',
                'allowAutoLogin'=>true,
            ),
            // uncomment the following to enable URLs in path-format
            'urlManager'=>array(
            'urlFormat'=>'path',
            'rules'=>array(
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                ),
            ),
            'db'=>array(
                'connectionString' => 'mysql:host=futurality.fi;dbname=futural_core',
                'emulatePrepare' => true,
                'username' => 'futural_core',
                'password' => 'futural',
                'charset' => 'utf8',
            ),
            'dbopenerp'=>array(
                'connectionString' => 'pgsql:host=erp.futurality.fi;dbname=futu_sopuli',
                'emulatePrepare' => true,
                'username' => 'openerp',
                'password' => 'futural',
                'charset' => 'utf8',
                'class' => 'CDbConnection' 
            ),
            'dbbank'=>array(
                'connectionString' => 'mysql:host=futurality.fi;dbname=futural_bank',
                'emulatePrepare' => true,
                'username' => 'futural_bank',
                'password' => 'futural',
                'charset' => 'utf8',
                'class' => 'CDbConnection' 
            ),
            'bootstrap' => array(
                'class' => 'ext.bootstrap.components.Bootstrap',
                'responsiveCss' => true,
            ),
            'errorHandler'=>array(
                // use 'site/error' action to display errors
                'errorAction'=>'site/error',
            ),
            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute',
                        'levels'=>'error, warning',
                    ),
                    // uncomment the following to show log messages on web pages
                    /*
                    array(
                        'class'=>'CWebLogRoute',
                    ),
                    //*/
                ),
            ),
            'mail' => array(
                'class' => 'ext.mail.YiiMail',
                'transportType' => 'smtp',
                'transportOptions' => array(
                    'host'=>'futurality.fi',
                    'username'=>'businesscenter@futurality.fi',
                    'password'=>'password',
                    'port'=>25,
                ),
                'viewPath' => 'application.views.mail',
                'logging' => true,
                'dryRun' => false
            ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
            // this is used in contact page
            'adminEmail'=>'helpdesk@futurable.fi',
            'businessCenterDb'=>'futu_sopuli',
	),
);
