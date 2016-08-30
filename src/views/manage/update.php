<?php

use DevGroup\Measure\helpers\MeasureHelper;
use DevGroup\Measure\models\Measure;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var boolean $hasAccess
 * @var DevGroup\Measure\models\Measure $model
 * @var yii\web\View $this
 */

$this->title = MeasureHelper::t($model->isNewRecord ? 'Create' : 'Update');
$this->params['breadcrumbs'] = [
    ['label' => MeasureHelper::t('Measures'), 'url' => ['index']],
    $this->title,
];

?>
<?php $form = ActiveForm::begin(); ?>
<div class="box">
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <?= $form->field($model, 'type')->dropDownList(Measure::getTypes(), ['prompt' => '']) ?>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'rate')->textInput() ?>
                <?= $form->field($model, 'format')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'converter_class_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-xs-12 col-md-6">
                <?= $form->field($model, 'use_custom_formatter')->checkbox() ?>
                <?= $form->field($model, 'decimal_separator')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'thousand_separator')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'min_fraction_digits')->textInput() ?>
                <?= $form->field($model, 'max_fraction_digits')->textInput() ?>
            </div>
        </div>
    </div>
    <?php if ($hasAccess) : ?>
        <div class="box-footer">
            <div class="form-group pull-right">
                <?= Html::submitButton($this->title, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php ActiveForm::end(); ?>
