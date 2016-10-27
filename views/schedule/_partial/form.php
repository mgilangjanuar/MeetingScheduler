<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datetime\DateTimePicker;
use vova07\imperavi\Widget as Imperavi;
?>

<div class="md-form">
    <div class="card">
        <?php $form = ActiveForm::begin() ?>

        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, 'startedAtPretty')->widget(DateTimePicker::classname(), [
                    'removeButton' => false,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd M yyyy hh:ii'
                    ],
                ]) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'endedAtPretty')->widget(DateTimePicker::classname(), [
                    'removeButton' => false,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd M yyyy hh:ii'
                    ],
                ]) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'duration', ['inputTemplate' => '<div class="form-line">{input}</div>']) ?>
            </div>
        </div>

        
        <?= Html::submitButton('SAVE', ['class' => 'btn btn-primary btn-block']) ?>

        <?php ActiveForm::end() ?>
    </div>
</div>