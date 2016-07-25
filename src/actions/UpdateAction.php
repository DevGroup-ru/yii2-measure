<?php

namespace DevGroup\Measure\actions;

use DevGroup\Measure\models\Measure;
use yii\base\Action;

/**
 * Class UpdateAction
 *
 * @package DevGroup\Measure\actions
 */
class UpdateAction extends Action
{
    /**
     * Updates an existing Measure model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function run($id = null)
    {
        if ($id === null) {
            $model = new Measure;
            $model->loadDefaultValues();
        } else {
            $model = $this->controller->findModel($id);
        }
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->controller->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->controller->render(
                'update',
                [
                    'model' => $model,
                ]
            );
        }
    }
}
