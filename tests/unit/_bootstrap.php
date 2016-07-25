<?php

$config = require(dirname(__DIR__) . '/config/unit.php');
unset($config['class']);
new yii\console\Application($config);
