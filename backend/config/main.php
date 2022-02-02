<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@staticRoot' => $params['staticPath'],
        '@static'   => $params['staticHostInfo'],

    ],
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => [
        'log',
        'common\bootstrap\SetUp',
        'backend\bootstrap\SetUp',
    ],
    'modules' => [],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['@'],
            'plugin' => [
                [
                    'class'=>'\mihaildev\elfinder\plugin\Sluggable',
                    'lowercase' => true,
                    'replacement' => '-'
                ]
            ],
            'roots' => [
                [
                    'baseUrl'=>'/uploads',
                    'basePath'=>'@common/uploads',
                    'path' => 'files',
                    'name' => 'Global'
                ],
            ],
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'cookieValidationKey'=>$params['cookieValidationKey']
        ],
        'user' => [
            'identityClass' => 'shop\entities\User\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity', 'httpOnly' => true,
               // 'domain'=>$params['cookieDomain'],
            ],
            'loginUrl'=>['site/login']
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced',
            /*'cookieParams'=>[
                'domain'=>$params['cookieDomain'],
                'httpOnly' => true,
            ]*/
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
        'frontendUrlManager'=> require __DIR__ . '/../../frontend/config/urlManager.php',
        'backendUrlManager'=> require __DIR__ . '/urlManager.php',
        'urlManager' =>  function(){
            return yii::$app->get('backendUrlManager');
        },
    ],
'as access' => [
        'class' => 'yii\filters\AccessControl',
        'except'=>['site/login','site/logout','site/error'],
        'rules' => [
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
    ],
    'params' => $params,
];
