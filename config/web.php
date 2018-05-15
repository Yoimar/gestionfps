<?php

$params = require(__DIR__ . '/params.php');
use kartik\mpdf\Pdf;
use kartik\datecontrol\Module;

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'es',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'sourceLanguage' => 'es',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'lTv0isNY4k5QQrTor309vRxUphGeqw4B',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'authManager'       => [
            'class'         => 'yii\rbac\DbManager',
            'defaultRoles'  => ['guest'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'dbsigesp' => require(__DIR__ . '/dbsigesp.php'),
        // Configuracion de Places dos amigos
        'places' => [
            'class' => '\dosamigos\google\places\Places',
            'key' => 'AIzaSyBzyQHuP5O9RW7Ep87OPJqC2RqtzxpAPXo',
            'format' => 'json' // or 'xml'
        ],
        'placesSearch' => [
            'class' => '\dosamigos\google\places\Search',
            'key' => 'AIzaSyBzyQHuP5O9RW7Ep87OPJqC2RqtzxpAPXo',
            'format' => 'json' // or 'xml'
        ],

        // Configuraciónd de Google Maps Dos Amigos
        'assetManager' => [
            'bundles' => [
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                        'key' => 'AIzaSyBzyQHuP5O9RW7Ep87OPJqC2RqtzxpAPXo',
                        'language' => 'es',
                        'version' => '3.1.18'
                        //'sensor'=> 'false'
                    ]
                ]
            ]
        ],


        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:d/m/Y',
            'datetimeFormat' => 'dd/MM/YYYY HH:mm:ss a',
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
            'currencyCode' => ' Bs',
            'nullDisplay' => '',
            //'defaultTimeZone' => 'America/Caracas',
            'timeZone' => 'UTC',
            'locale' => 'es'
        ],

        'pdf' => [
        'class' => Pdf::classname(),
        'format' => Pdf::FORMAT_LETTER,
        'orientation' => Pdf::ORIENT_PORTRAIT,
        'destination' => Pdf::DEST_BROWSER,
        // refer settings section for all configuration options
        ],

    ],
    'params' => $params,

    'modules'=>[
        'dynagrid'=> [
            'class'=>'\kartik\dynagrid\Module',
        ],
        'gridview'=> [
            'class'=>'\kartik\grid\Module',
        ],
        'datecontrol' =>  [
        'class' => '\kartik\datecontrol\Module',

         'displaySettings' => [
            Module::FORMAT_DATE => 'php:d-m-Y',
            Module::FORMAT_TIME => 'hh:mm:ss a',
            Module::FORMAT_DATETIME => 'dd-MM-yyyy hh:mm:ss a',
        ],

        // format settings for saving each date attribute (PHP format example)
        'saveSettings' => [
            Module::FORMAT_DATE => 'php:m-d-Y', // saves as unix timestamp
            Module::FORMAT_TIME => 'php:H:i:s',
            Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
        ],

        // set your display timezone
//        'displayTimezone' => 'America/Caracas',

        // set your timezone for date saved to db
//        'saveTimezone' => 'America/Caracas',

        // automatically use kartik\widgets for each of the above formats
        'autoWidget' => true,

        // default settings for each widget from kartik\widgets used when autoWidget is true
        'autoWidgetSettings' => [
            Module::FORMAT_DATE => ['type'=>2, 'pluginOptions'=>['autoclose'=>true]], // example
            Module::FORMAT_DATETIME => ['pluginOptions'=>['autoclose'=>true]], // setup if needed
            Module::FORMAT_TIME => [], // setup if needed
        ],

        // custom widget settings that will be used to render the date input instead of kartik\widgets,
        // this will be used when autoWidget is set to false at module or widget level.
        'widgetSettings' => [
            Module::FORMAT_DATE => [
                'class' => 'kartik\date\DatePicker', // example
                'options' => [
                    'dateFormat' => 'php:d-m-Y',
                    'options' => ['class'=>'form-control'],
                ]
            ]
        ]
        // other settings
    ],
        ],
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
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
