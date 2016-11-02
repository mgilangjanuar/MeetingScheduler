<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use vova07\imperavi\Widget as Imperavi;
?>

<div class="md-form">
    <div class="card">
        <?php $form = ActiveForm::begin() ?>

        <div class="row">
            <div class="col-sm-7">
                <?= $form->field($model, 'name', ['inputTemplate' => '<div class="form-line">{input}</div>']) ?>
            </div>
            <div class="col-sm-5">
                <?= $form->field($model, 'can_book_before', ['inputOptions' => ['value' => $model->isNewRecord ? 30 : ($model->canBookPretty)], 'inputTemplate' => '<div class="form-line">{input}</div>']) ?>
            </div>
        </div>

        <?= $form->field($model, 'slug', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon">janjian.ga/!/</span><div class="form-line">{input}</div></div>'])->label(false) ?>

        <?= $form->field($model, 'description', ['options' => ['class' => '']])->widget(Imperavi::className(), [
            'settings' => [
                'buttons' => ['bold', 'italic', 'deleted', 'orderedlist', 'link']
            ]
        ]) ?>
        
        <?= Html::submitButton(($model->isNewRecord ? 'SAVE' : 'UPDATE'), ['class' => 'btn btn-primary btn-block waves-effect']) ?>

        <?php ActiveForm::end() ?>
    </div>
</div>
