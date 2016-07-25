<?php

namespace DevGroup\Measure\controllers;

use DevGroup\Measure\models\Measure;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ManageController implements the CRUD actions for Measure model.
 */
class ManageController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return $this->module->manageControllerBehaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => 'DevGroup\Measure\actions\ListAction',
            ],
            'update' => [
                'class' => 'DevGroup\Measure\actions\UpdateAction',
            ],
            'delete' => [
                'class' => 'DevGroup\Measure\actions\DeleteAction',
            ],
        ];
    }

    /**
     * Finds the Measure model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Measure the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id)
    {
        if (($model = Measure::getById($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
