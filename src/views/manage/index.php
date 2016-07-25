<?php

use DevGroup\Measure\helpers\MeasureHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var \DevGroup\Measure\models\Measure $model
 * @var yii\web\View $this
 */

$this->title = MeasureHelper::t('Measures');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="measure-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(MeasureHelper::t('Create'), ['update'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?=
    GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                [
                    'attribute' => 'type',
                    'filter' => \DevGroup\Measure\models\Measure::getTypes(),
                    'value' => function ($model, $key, $index, $column) {
                        return \DevGroup\Measure\helpers\MeasureHelper::t($model->{$column->attribute});
                    },
                ],
                'name',
                'unit',
                'rate',
//                'format',
                [
                    'attribute' => 'use_custom_formatter',
                    'filter' => [0 => MeasureHelper::t('No'), 1 => MeasureHelper::t('Yes')],
                    'value' => function ($model, $key, $index, $column) {
                        return \DevGroup\Measure\helpers\MeasureHelper::t(
                            $model->{$column->attribute} == 1 ? 'Yes' : 'No'
                        );
                    },
                ],
//                 'decimal_separator',
//                 'thousand_separator',
//                 'min_fraction_digits',
//                 'max_fraction_digits',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                ],
            ],
            'filterModel' => $model,
            'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed'],
        ]
    )
    ?>
    <?php Pjax::end(); ?>
</div>
