<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'reservation-app',
    'name' => 'Reservation',
    'language' => 'fr',
    //'defaultRoute' => 'module\LandingPage',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log', 'app\Bootstrap',
    ],

    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@test'   => '@app/test',
    ],

    'modules' => [
        'admin' => [
            // to use menu manager (optional) run those migrations:
            //./yii migrate --migrationPath=@mdm/admin/migrations
            'class' => 'mdm\admin\Module',
            //            'class' => 'mdm\admin\Module',
            //            'menus' => [
            //                'user' => null,
            //            ],            
            // extension config:
            //            'layout' => 'left-menu',
            //            'mainLayout' => '@app/views/layouts/main.php',            
            //            // standard config:
            //            'layout' => '@admin/views/layouts/main',
            // Customizing Assignment Controllers
            //            'controllerMap' => [
            //                'assignment' => [
            //                    'class' => 'mdm\admin\controllers\AssignmentController',
            //                ]
            //            ]
        ],
        'notifications' => [
            'class' => 'webzop\notifications\Module',
            'channels' => [
                'screen' => [
                    'class' => 'webzop\notifications\channels\ScreenChannel',
                ],
                'email' => [
                    'class' => 'webzop\notifications\channels\EmailChannel',
                    'message' => [
                        'from' => 'example@email.com'
                    ],
                ],
            ],
            'controllerMap' => [
                'default' => 'app\controllers\notification\NotificationController',
                'fixture' => [ // Fixture generation command line.
                  
                ],
            ],
        ],

        'gridview' => [
            'class' => '\kartik\grid\Module',
            // see settings on http://demos.krajee.com/grid#module
        ],
        'datecontrol' => [
            'class' => '\kartik\datecontrol\Module',
            // see settings on http://demos.krajee.com/datecontrol#module
        ],
        // If you use tree table
        /*      'treemanager' =>  [
          'class' => '\kartik\tree\Module',
          // see settings on http://demos.krajee.com/tree-manager#module
      ]*/
        'user' => [
            'class' => \dektrium\user\Module::className(), //'dektrium\user\Module',
            //            'enableUnconfirmedLogin' => true,
            'enableFlashMessages' => false, // avoid double flash messages
            // you can Impersonate User at: /user/admin/switch
            'admins' => ['admin'], //allows access to: '/user/admin/index'
            'modelMap' => [
                'User' => 'app\models\User',
                'RegistrationForm' => 'app\models\user\RegistrationForm',
            ],
            // Override controllers & handle events
            'controllerMap' => [
                //                // override AdminController
                'admin' => 'app\controllers\user\AdminController',
                'profile' => 'app\controllers\user\ProfileController',
                //                // change admin layout
                //                'layout' => 'path-to-your-admin-layout',
                //                // This event listener will redirect user to login page after successful registration
                'registration' => [
                    'class' => \dektrium\user\controllers\RegistrationController::className(),
                    'on ' . \dektrium\user\controllers\RegistrationController::EVENT_AFTER_REGISTER => function ($e) {
                        Yii::$app->response->redirect(array('/user/security/login'))->send();
                        Yii::$app->end();
                    }
                ],
            ],
            // config mailer
            /*'mailer' => [
                'sender'                => 'no-reply@clicangoevent.com', // or ['no-reply@clicangoevent.com' => 'Sender name']
                'welcomeSubject'        => 'Welcome subject',
                'confirmationSubject'   => 'Confirmation subject',
                'reconfirmationSubject' => 'Email change subject',
                'recoverySubject'       => 'Recovery subject',
            ],*/
            /*   'mailer' => [
        'sender'                => 'no-reply@clicangoevent.com', // or ['no-reply@myhost.com' => 'Sender name']
        'welcomeSubject'        => 'Welcome subject',
        'confirmationSubject'   => 'Confirmation subject',
        'reconfirmationSubject' => 'Email change subject',
        'recoverySubject'       => 'Recovery subject',
],*/
            /* 'mailer' => [
        'sender'                => 'http://clicangoevent.com', // or ['no-reply@myhost.com' => 'Sender name']
        'welcomeSubject'        => 'Welcome subject',
        'confirmationSubject'   => 'Confirmation subject',
        'reconfirmationSubject' => 'Email change subject',
        'recoverySubject'       => 'Recovery subject',
],*/
            //Disabled email confirmation for user registration
            // 'enableConfirmation' => false,
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',
        'api' => [
            'class' => 'app\modules\api\Module',
            'class' => 'app\modules\api\Bill',
        ],
        'LandingPage' => [
            'class' => 'app\modules\LandingPage\LandingPage',
        ],
        'Filter' => [
            'class' => 'app\modules\Filter\Filter',

        ],
        'Inscription' => [
            'class' => 'app\modules\Inscription\Inscription',
        ],
        'InscriptionService' => [
            'class' => 'app\modules\InscriptionService\InscriptionService',
        ],
    ],

    'components' => [

        'mailer' => [

            'viewPath' => '@app/views/user/mail'

        ],
        'session' => [
            'timeout' => 60 * 60 * 24 * 14, // 2 weeks, 3600 - 1 hour, Default 1440
        ],
        'geoip' => ['class' => 'lysenkobv\GeoIP\GeoIP'],
        'notifier' => [
            'class' => '\tuyakhov\notifications\Notifier',
            'channels' => [
                'mail' => [
                    'class' => '\tuyakhov\notifications\channels\MailChannel',
                    'from' => 'no-reply@example.com'
                ],
                'sms' => [
                    'class' => '\tuyakhov\notifications\channels\TwilioChannel',
                    'accountSid' => '...',
                    'authToken' => '...',
                    'from' => '+1234567890'
                ],
                'telegram' => [
                    'class' => '\tuyakhov\notifications\channels\TelegramChannel',
                    'botToken' => '...'
                ],
                'database' => [
                    'class' => '\tuyakhov\notifications\channels\ActiveRecordChannel'
                ],
                'assetManager' => [
                    'bundles' => [
                        'kartik\form\ActiveFormAsset' => [
                            'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
                        ],
                        'dosamigos\google\maps\MapAsset' => [
                            'options' => [
                                'key' => 'AIzaSyB7Iz5ZKGr0_5l_LD47xNf9umU7GSiUVuw',
                                'language' => 'id',
                                'version' => '3.1.18'
                            ]
                        ]
                    ],
                ],
            ],
        ],
        'request' => [
            'cookieValidationKey' => 'Io2Z-ayFDJyzb_woVAI3bsxli_tFVP7B',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            //'identityClass' => 'app\models\User', // to use "dektrium\user" instead
            'enableAutoLogin' => true,
            //            'loginUrl' => [
            //'admin/user/login' // default login for yii2-admin extension
            //                ],
        ],
        //defining the componennts of the Partner
        'saveNext' => [
            'class' => 'app\components\saveNext'
        ],
        'step1' => [
            'class' => 'app\components\step1'
        ],
        'step2' => [
            'class' => 'app\components\step2'
        ],
        'step3' => [
            'class' => 'app\components\step3'
        ],
        'Filter' => [
            'class' => 'app\components\Filter'
        ],
        'FilterBien' => [
            'class' => 'app\components\FilterBien'
        ],
        'FilterCater' => [
            'class' => 'app\components\FilterCater'
        ],
        'FilterSecurity' => [
            'class' => 'app\components\FilterSecurity'
        ],
        'FilterHost' => [
            'class' => 'app\components\FilterHost'
        ],
        'FilterPhoto' => [
            'class' => 'app\components\FilterPhoto'
        ],
        'FiltreEquipement' => [
            'class' => 'app\components\FiltreEquipement'
        ],
        'FiltreAnimation' => [
            'class' => 'app\components\FiltreAnimation'
        ],
        'FilterRoom' => [
            'class' => 'app\components\FilterRoom'
        ],
        // if you want to override '@dektrium/user/views'
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user',
                    '@webzop/notifications/views' => '@app/views/notification'
                ],
            ],
        ],
        /*/ Authentication via social networks (https://github.com/dektrium/yii2-user/blob/master/docs/social-auth.md)
        'authClientCollection' => [
            'class' => yii\authclient\Collection::className(),
            'clients' => [
                'facebook' => [
                    'class'        => 'dektrium\user\clients\Facebook',
                    'clientId'     => 'CLIENT_ID',
                    'clientSecret' => 'CLIENT_SECRET',
                ],
                'twitter' => [
                    'class'          => 'dektrium\user\clients\Twitter',
                    'consumerKey'    => 'CONSUMER_KEY',
                    'consumerSecret' => 'CONSUMER_SECRET',
                ],
                'google' => [
                    'class'        => 'dektrium\user\clients\Google',
                    'clientId'     => 'CLIENT_ID',
                    'clientSecret' => 'CLIENT_SECRET',
                ],
            ],
        ],*/
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        /*   'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                 'class' => 'Swift_SmtpTransport',
                'host' => $_ENV['MAILER_HOST'],
                'username' => $_ENV['MAILER_USERNAME'],
                'password' => $_ENV['MAILER_PASSWORD'],
                'port' => $_ENV['MAILER_PORT'],
                'encryption' => $_ENV['MAILER_ENCRYPTION'],
            ]
        ],*/
        'log' => [
            'flushInterval' => 1,
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'exportInterval' => 1,
                    'logVars' => []
                ],
            ],
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning', 'trace', 'info'],
                ],
                [
                    'class' => 'yii\log\EmailTarget',
                    'levels' => ['error', 'warning'],
                    'categories' => ['yii\db\*'],
                    'message' => [
                        'from' => ['log@mydomain.com'],
                        'to' => ['admin@mydomain.com', 'developer@mydomain.com'],
                        'subject' => 'Application errors at mydomain.com',
                    ],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            // ...
            'rules' => [
                // ...
                'notifications/poll' => '/notifications/notifications/poll',
                'notifications/rnr' => '/notifications/notifications/rnr',
                'notifications/read' => '/notifications/notifications/read',
                'notifications/read-all' => '/notifications/notifications/read-all',
                'notifications/delete-all' => '/notifications/notifications/delete-all',
                'notifications/delete' => '/notifications/notifications/delete',
                'notifications/flash' => '/notifications/notifications/flash',
                // ...
            ]
            // ...
        ],
        /*'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

            ],
        ],*/
        // Custom AssetManager files
        /*'assetManager' => [
           'bundles' => [
                \yii\bootstrap4\BootstrapAsset::class => [
                    'css' => ['/vendor/bower-asset/bootstrap/dist/css/bootstrap.css']
                ],
           ],
        ],*/
        'assetManager' => [

            'converter' => [

                'class' => 'yii\web\AssetConverter',

                'commands' => [

                    'less' => ['css', 'lessc {from} {to} --no-color'],

                ],

            ],

        ],

    ],
    /*    'as access' => [
//    'as beforeRequest' => [
//        'class' => \yii\filters\AccessControl::className(),
//        'class' => 'dektrium\rbac\components\AccessControl',
        'class' => \mdm\admin\components\AccessControl::className(),
        'allowActions' => [
            'site/*',
            'admin/*',
            'partner/*',
            'product/*',
            'reservation/*',
            'payment/*',
            'subscription/*',
            'user/*',
            'rbac/*',
            'gii/*',
            'debug/*',
//            'some-controller/some-action',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ],
        
    ],*/
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [],
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
