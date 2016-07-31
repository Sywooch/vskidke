<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'name' => 'Vskidke',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'eauth' => [
            'class' => 'nodge\eauth\EAuth',
            'popup' => true, // Use the popup window instead of redirecting.
            'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache' on production environments.
            'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
            'httpClient' => [
                // uncomment this to use streams in safe_mode
//                'useStreamsFallback' => true,
            ],
            'services' => [ // You can change the providers and their classes.
                'facebook' => [
                    // register your app here: https://developers.facebook.com/apps/
                    'class' => 'frontend\components\CustomFacebookService',
                    'clientId' => '1560917077537659',
                    'clientSecret' => '774be783964b13eb94d07a4a753fe789',
                ],
                'vkontakte' => [
                    // register your app here: https://vk.com/editapp?act=create&site=1
                    'class' => 'frontend\components\CustomVkAuth',
                    'clientId' => '5525531',
                    'clientSecret' => 'BCGXYNUkIalqaNIa3yYS',
                ],
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'logFile' => '@app/runtime/logs/eauth.log',
                    'categories' => ['nodge\eauth\*'],
                    'logVars' => [],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class'           => 'frontend\components\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'discount-api'],
                '/<city:[a-z0-9_\-.]+>'      => 'discount/index',
                '<controller:[a-zA-Z0-9\-]+>/<city:[a-z0-9_\-.]+>/<id:\d+>'                         => '<controller>/view',
                '<controller:[a-zA-Z0-9\-]+>/<city:[a-z0-9_\-.]+>'                                  => '<controller>/index',
                'login/<city:[a-z0-9_\-.]+>/<service:vkontakte|facebook>'                                                => 'site/login',
                '<controller:[a-zA-Z0-9\-]+>/<city:[a-z0-9_\-.]+>/<action:[a-zA-Z0-9\-]+>/<id:\d+>' => '<controller>/<action>',
                '<controller:[a-zA-Z0-9\-]+>/<city:[a-z0-9_\-.]+>/<action:[a-zA-Z0-9\-]+>'          => '<controller>/<action>',
                '<controller:[a-zA-Z0-9\-]+>/<action:[a-zA-Z0-9\-]+>'                               => '<controller>/<action>',
                'logout' => 'site/logout',
                'signup' => 'site/signup',
            ],
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'i18n' => [
            'translations' => [
                'eauth' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@eauth/messages',
                ],
            ],
        ],
    ],
    'params' => $params,
];
