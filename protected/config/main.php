<?php
require_once( dirname(__FILE__) . '/../components/helpers.php');

// uncomment the following to define a path alias
//Yii::setPathOfAlias('local','path/to/local-folder');
//Yii::setPathOfAlias('chartjs', dirname(__FILE__).'/../extensions/yii-chartjs');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'defaultController' => 'app/dashboard',
	'name'=>'ODS',
        'sourceLanguage'=>'00',
        'language'=>'fil',
        'language'=>'en',
	// preloading 'log' component
//	'preload'=>array('log','bootstrap','chartjs'),
	'preload'=>array('log','bootstrap'),

	// autoloading model and component classes
	'import'=>array(
 		'application.models.*',
        	'application.components.*',
        	'application.modules.user.models.*',
        	'application.modules.user.components.*',
		'application.modules.rights.*',
		'application.modules.rights.components.*',
	),

        'theme'=>'bootstrap',
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'vhilly27',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('*','::1'),
                       'generatorPaths'=>array(
                         'bootstrap.gii',
                        ),
		),
     'user'=>array(
 'tableUsers' => 'users',
                'tableProfiles' => 'profiles',
                'tableProfileFields' => 'profiles_fields',
            # encrypting method (php hash function)
            'hash' => 'md5',
 
            # send activation email
            'sendActivationMail' => true,
 
            # allow access for non-activated users
            'loginNotActiv' => false,
 
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,
 
            # automatically login from registration
            'autoLogin' => true,
 
            # registration path
            'registrationUrl' => array('/user/registration'),
 
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
 
            # login form path
            'loginUrl' => array('/user/login'),
 
            # page after login
            'returnUrl' => array('/user/profile'),
 
            # page after logout
            'returnLogoutUrl' => array('/user/login'),
        ),
        'rights'=>array(
	               'superuserName'=>'Admin', // Name of the role with super user privileges. 
        	       'authenticatedName'=>'Authenticated',  // Name of the authenticated user role. 
	               'userIdColumn'=>'id', // Name of the user id column in the database. 
	               'userNameColumn'=>'username',  // Name of the user name column in the database. 
	               'enableBizRule'=>true,  // Whether to enable authorization item business rules. 
	               'enableBizRuleData'=>true,   // Whether to enable data for business rules. 
	               'displayDescription'=>true,  // Whether to use item description instead of name. 
	               'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages. 
	               'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages. 
 
	               'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested. 
	               //'layout'=>'rights.views.layouts.main',  // Layout to use for displaying Rights. 
	               //'appLayout'=>'application.views.layouts.main', // Application layout. 
	               //'cssFile'=>'rights.css', // Style sheet file to use for Rights. 
	               'install'=>false,  // Whether to enable installer. 
	               'debug'=>false, 
        ),
	),

	// application components
	'components'=>array(


          'barcodegenerator' => array(
            'class' => 'ext.barcodegenerator.BarcodeGeneratorController',
          ),
//...
    'ePdf' => array(
        'class'         => 'ext.yii-pdf.EYiiPdf',
        'params'        => array(
            'mpdf'     => array(
                'librarySourcePath' => 'application.vendors.mpdf.*',
                'constants'         => array(
                    '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                ),
                'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
                /*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                    'mode'              => '', //  This parameter specifies the mode of the new document.
                    'format'            => 'A4', // format A4, A5, ...
                    'default_font_size' => 0, // Sets the default document font size in points (pt)
                    'default_font'      => '', // Sets the default font-family for the new document.
                    'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                    'mgr'               => 15, // margin_right
                    'mgt'               => 16, // margin_top
                    'mgb'               => 16, // margin_bottom
                    'mgh'               => 9, // margin_header
                    'mgf'               => 9, // margin_footer
                    'orientation'       => 'P', // landscape or portrait orientation
                )*/
            ),
            'HTML2PDF' => array(
                'librarySourcePath' => 'application.vendors.html2pdf.*',
                'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                /*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                    'orientation' => 'P', // landscape or portrait orientation
                    'format'      => 'A4', // format A4, A5, ...
                    'language'    => 'en', // language: fr, en, it ...
                    'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                    'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                    'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                )*/
            )
        ),
    ),
    //...

		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/

	//'chartjs' => array('class' => 'chartjs.components.ChartJs'),
       'bootstrap' => array(
	    'class' => 'ext.bootstrap.components.Bootstrap',
	    'responsiveCss' => true,
	    'fontAwesomeCss'=>true,
            'ajaxJsLoad'=>true,
	),

      'user'=>array(
            // enable cookie-based authentication
            'class' => 'RWebUser',
            'allowAutoLogin'=>true,
            'loginUrl' => array('/user/login'),
        ),
        'authManager'=>array(
                'class'=>'RDbAuthManager',
                'connectionID'=>'db',
                'defaultRoles'=>array('Authenticated', 'Guest'),
        ),

       'db'=>array(
	 'connectionString' => 'mysql:host=localhost;dbname=online_delivery',
	 'emulatePrepare' => true,
	 'username' => 'root',
	 'password' => 'mysqladmin',
	 'charset' => 'utf8',
         'enableParamLogging'=>true,
         'enableProfiling'=>true,
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
       // array(
         // 'class'=>'CProfileLogRoute',

        //),
        // uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
