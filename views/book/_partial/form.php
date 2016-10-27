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

        <?= $form->field($model, 'note', ['options' => ['class' => '']])->widget(Imperavi::className(), [
            'settings' => [
                'buttons' => ['bold', 'italic', 'deleted', 'orderedlist', 'link']
            ]
        ]) ?>
        
        <?= Html::submitButton(('BOOK'), ['class' => 'btn btn-primary btn-block']) ?>

        <?php ActiveForm::end() ?>
    </div>
</div>
