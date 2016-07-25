<?php

namespace DevGroup\Measure\actions;

use DevGroup\Measure\models\Measure;
use yii\base\Action;

/**
 * Class ListAction
 * @package DevGroup\Measure\actions
 */
class ListAction extends Action
{
    /**
     * Lists all Measure models.
     * @return mixed
     */
    public function run()
    {
        $model = new Measure;
        return $this->controller->render(
            'index',
            [
                'dataProvider' => $model->search(\Yii::$app->request->get()),
                'model' => $model,
            ]
        );
    }
}
