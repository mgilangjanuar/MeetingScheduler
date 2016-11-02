<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View              $this
 * @var dektrium\user\models\User $user
 * @var dektrium\user\Module      $module
 */

$this->title = Yii::t('user', 'Sign Up');
?>

<div class="container-fluid">
    <div class="row">
    
        <div class="well container-main-title">
            <h1 class="main-title"><?= $this->title ?></h1>
        </div>

        <div class="login-form">
            <div class="card">
                <?php $form = ActiveForm::begin([
                    'id'                     => 'registration-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                ]); ?>

                <?= $form->field($model, 'email', ['inputTemplate' => '<div class="form-line">{input}</div>']) ?>

                <?= $form->field($model, 'username', ['inputTemplate' => '<div class="form-line">{input}</div>']) ?>

                <?php if ($module->enableGeneratingPassword == false): ?>
                    <?= $form->field($model, 'password', ['inputTemplate' => '<div class="form-line">{input}</div>'])->passwordInput() ?>
                <?php endif ?>

                <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-primary btn-block waves-effect']) ?>

                <?php ActiveForm::end(); ?>

                <h5 class="strikeout text-center">
                    <span>OR</span>
                </h5>
                
                <div class="p-b-10 p-l-10 p-r-10">
                    <?= Html::a(Html::img('@web/themes/default/images/sign-in-with-sso-ui.png', ['class' => 'img-responsive']), ['login-sso-ui']) ?>
                </div>
            </div>
        </div>

        <p class="text-center">
            <?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
        </p>

    </div>
</div>
