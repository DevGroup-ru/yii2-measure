<?php

namespace DevGroup\Measure\tests\unit;

class UnitTestCase extends \yii\codeception\TestCase
{
    /**
     * @inheritdoc
     */
    public $appConfig = '@tests/config/unit.php';

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();
        \Yii::$app->runAction('migrate/up', ['interactive' => 0, 'migrationPath' => '@app/../src/migrations']);
    }

    /**
     * @inheritdoc
     */
    protected function tearDown()
    {
        \Yii::$app->runAction('migrate/down', ['all', 'interactive' => 0, 'migrationPath' => '@app/../src/migrations']);
        parent::tearDown();
    }
}
