<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'aliases' => [
        '@DevGroup/Measure' => realpath(dirname(dirname(__DIR__)) . '/src'),
        '@bower' => dirname(dirname(__DIR__)) . '/vendor/bower-asset',
    ],
    'id' => 'minimal',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'DevGroup\Measure\Bootstrap'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'b7RRqq6h6yzm7SRaguDfqgOzP_i68G8E',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'modules' => [
        'measure' => [
            'class' => 'DevGroup\Measure\Module',
        ],
    ],
    'params' => $params,
];

return $config;
