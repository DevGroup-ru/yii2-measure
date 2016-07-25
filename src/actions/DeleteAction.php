<?php

namespace DevGroup\Measure\actions;

use yii\base\Action;

/**
 * Class DeleteAction
 * @package DevGroup\Measure\actions
 */
class DeleteAction extends Action
{
    /**
     * Deletes an existing Measure model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function run($id)
    {
        $this->controller->findModel($id)->delete();
        return $this->controller->redirect(['index']);
    }
}
