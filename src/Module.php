<?php

namespace DevGroup\Measure;

class Module extends \yii\base\Module
{
    /**
     * Behaviors list. You can change it in your application configuration file.
     * @var array of behavior definitions
     */
    public $manageControllerBehaviors = [
        'access' => [
            'class' => 'yii\filters\AccessControl',
            'rules' => [
                [
                    'actions' => ['index', 'update'],
                    'allow' => true,
                    'roles' => ['measure-view-measure'],
                ],
                [
                    'actions' => ['delete'],
                    'allow' => true,
                    'roles' => ['measure-delete-measure'],
                ],
                [
                    'allow' => false,
                    'roles' => ['*'],
                ],
            ],
        ],
        'verbs' => [
            'class' => 'yii\filters\VerbFilter',
            'actions' => [
                'delete' => ['POST'],
            ],
        ]
    ];
}
