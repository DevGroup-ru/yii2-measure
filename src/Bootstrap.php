<?php

namespace DevGroup\Measure;

use Yii;

class Bootstrap implements \yii\base\BootstrapInterface
{
    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param \yii\base\Application $app the application currently running
     */
    public function bootstrap($app)
    {
        Yii::$app->i18n->translations['measure'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@DevGroup/Measure/messages',
        ];
    }
}
