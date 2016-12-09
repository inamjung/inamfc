<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name'=>'INAM - Yii - CLUB',
    'language'=>'th_TH',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
//        'view'=>[
//            'theme'=>[
//                'pathMap'=>[
//                    '@app/views'=>'@app/themes/adminlte'
//                ]
//            ]
//        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'mc9Ad5A1AptB83IbBny-r344cfvBOwhj',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        'authManager' => [
            'class' => 'dektrium\rbac\components\DbManager',
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'modules'=>[
         'gridview'=>[
            'class'=>'kartik\grid\Module'            
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin']
         ],
        'rbac' => [
            'class'=>'dektrium\rbac\RbacWebModule',
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',            
        ]
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'user/registration/*',
            'admin/*',
            'gii/*',
            'debug/*',
            'member/customers/*'
                   ]
    ],
    'modules' => [
        'member' => [
            'class' => 'app\modules\member\Module',
          ],
        ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
