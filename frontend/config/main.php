<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers', 
   // 'defaultRoute' => 'site/index',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\Frontend',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_frontendUser', // unique for frontend
            ]
        ],
        'session' => [
            'name' => 'Swim987963frontend',
            'savePath' => sys_get_temp_dir(),
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'sdfafsdsd',
            'csrfParam' => '_frontendCSRF',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
     
      'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                'login'=>'login/login',
                'registration'=>'login/registration',
                'profile-upload'=>'customer-api/profile-upload',
                'profile-retrieve'=>'customer-api/profile-retrieve',
                'profile-update'=>'customer-api/profile-update',
                'event-list'=>'customer-api/event-list',
                'reset-password'=>'customer-api/reset-password',
                'bookmark-history'=>'customer-api/bookmark-history',
                'add-bookmark'=>'customer-api/add-bookmark',
                //'news/<id:\w+>' => 'newslisting/index', 
				
            ],  
        ],
        
    ],
    'params' => $params,
];
