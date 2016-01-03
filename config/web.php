<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id'         => 'basic',
    'basePath'   => dirname(__DIR__),
    'bootstrap'  => ['log'],
    'language'   => 'ru',
    'aliases'    => [
        '@csRoot' => __DIR__ . '/../vendor/dram1008/library/lib',
        '@web'    => __DIR__ . '/../public_html',
    ],
    'components' => [
        'request'      => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey'    => '',
            'enableCookieValidation' => false,
            'enableCsrfValidation'   => false,
        ],
        'urlManager'   => [
            'enablePrettyUrl'     => true,
            'showScriptName'      => false,
            'enableStrictParsing' => true,
            'suffix'              => '',
            'rules'               => require(__DIR__ . '/urlRules.php'),
        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        'user'         => [
            'identityClass'   => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'formatter'    => [
            'dateFormat'        => 'dd.MM.yyyy',
            'timeFormat'        => 'php:H:i:s',
            'datetimeFormat'    => 'php:d.m.Y H:i',
            'decimalSeparator'  => '.',
            'thousandSeparator' => ' ',
            'currencyCode'      => 'RUB',
            'locale'            => 'ru-RU',
            'nullDisplay'       => '',
        ],
        'view'         => [
            'renderers' => [
                'tpl' => [
                    'class'     => 'yii\smarty\ViewRenderer',
                    'cachePath' => '@runtime/Smarty/cache',
                    'widgets'   => [
                        'blocks' => [
                            'ActiveForm' => 'yii\widgets\ActiveForm',
                        ],
                    ],
                ],
            ],
        ],
        'authClientCollection' => [
            'class'   => 'yii\authclient\Collection',
            'clients' => require(__DIR__ . '/authClientCollection.php'),
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer'       => require(__DIR__ . '/mailerTransport.php'),
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'       => 'yii\log\FileTarget',
                    'levels'      => [
                        'error',
                        'warning',
                    ],
                    'maxLogFiles' => 1,
                ],
                [
                    'class'      => 'yii\log\DbTarget',
                    'categories' => ['tg\\*'],
                ],
                [
                    'class'      => 'yii\log\EmailTarget',
                    'levels'     => [
                        'error',
                        'warning',
                    ],
                    'categories' => ['yii\db\*'],
                    'message'    => [
                        'from'    => ['admin@galaxysss.ru'],
                        'to'      => ['god@galaxysss.ru'],
                        'subject' => 'BOG-DAN.COM ERROR',
                    ],
                ],
            ],
        ],
        'db'           => require(__DIR__ . '/db.php'),
    ],
    'params'     => $params,
    'controllerMap' => [
        'upload'              => 'cs\Widget\FileUploadMany\UploadController',
        'html_content'        => 'cs\Widget\HtmlContent\Controller',
    ],
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
