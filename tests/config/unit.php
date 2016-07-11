<?php

return [
    'id' => 'app-console',
    'class' => 'yii\console\Application',
    'basePath' => \Yii::getAlias('@tests'),
    'runtimePath' => \Yii::getAlias('@tests/_output'),
    'sourceLanguage' => 'en-US',
    'language' => 'ru',
    'bootstrap' => [],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2_measure',
            'username' => 'root',
            'password' => 'root',
        ],
        'formatter' => [
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
        ],
    ]
];