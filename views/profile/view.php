<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->username;
?>

<div class="profile-view">

    <div class="well container-main-title main-title text-center">
        <?= Html::img($model->profile->getAvatarUrl(150), [
            'class' => 'img-circle img-responsive img-center',
        ]) ?>

        <h2><?= $model->profile->name ? Html::encode($model->profile->name) : Html::encode($model->username) ?></h2>
        <p><?= Html::encode($model->email) ?></p>
    </div>

    <div class="row">
        <?php if ($model->profile->bio || $model->profile->website): ?>
            <div class="col-sm-6">
                <?php if ($model->profile->bio): ?>
                    <div class="card">
                        <div class="header">
                            <h2><i class="fa fa-user"></i> Bio</h2>
                        </div>
                        <div class="body text-center">
                            <p><?= Html::encode($model->profile->bio) ?></p>
                        </div>
                    </div>
                <?php endif ?>
                <?php if ($model->profile->website): ?>
                    <div class="card">
                        <div class="header">
                            <h2><i class="fa fa-globe"></i> Website</h2>
                        </div>
                        <div class="body text-center">
                            <p class="lead truncate"><?= Html::a(substr(Html::encode($model->profile->website), strpos(Html::encode($model->profile->website), '://') + 3), $model->profile->website) ?></p>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        <?php endif ?>
        <div class="col-sm-6">
            <?php if ($model->profile->public_email): ?>
                <div class="card">
                    <div class="header">
                        <h2><i class="fa fa-envelope"></i> Email</h2>
                    </div>
                    <div class="body text-center">
                        <p class="lead truncate"><?= Html::a(Html::encode($model->profile->public_email), 'mailto:' . Html::encode($model->profile->public_email)) ?></p>
                    </div>
                </div>
            <?php endif ?>
            <?php if ($model->profile->location): ?>
                <div class="card">
                    <div class="header">
                        <h2><i class="fa fa-map-marker"></i> Location</h2>
                    </div>
                    <div class="body text-center">
                        <p class="lead"><?= Html::encode($model->profile->location) ?></p>
                    </div>
                </div>
            <?php endif ?>
            <?php if ($model->profile->timezone): ?>
                <div class="card">
                    <div class="header">
                        <h2><i class="fa fa-clock-o"></i> Timezone</h2>
                    </div>
                    <div class="body text-center">
                        <p class="lead"><?= Html::encode($model->profile->timezone) ?></p>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>

    <?php if ($model->id == Yii::$app->user->id): ?>
        <br /><br /><br />
        <?= Html::a('<i class="material-icons">edit</i>', ['/user/settings/profile'], ['class' => 'btn btn-warning btn-circle-lg waves-effect waves-circle waves-float btn-float']) ?>
    <?php endif ?>
</div>