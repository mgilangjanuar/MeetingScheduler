<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Dashboard';
?>

<div class="site-dashboard">
    <div class="well container-main-title">
        <h1 class="main-title"><?= $this->title ?></h1>
    </div>

    <?php if (! $models): ?>
        <p class="text-center not-set">you haven't schedule yet, hooray!</p>
    <?php endif ?>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <?php foreach ($models as $model): ?>
                <div class="card">
                    <div class="header text-center bg-<?= $model->user_id == Yii::$app->user->id ? 'deep-orange' : 'teal' ?>">
                        <h2 class="truncate">
                            <?= Html::a($model->event->name, ['/!/' . $model->event->slug], ['class' => 'not-style']) ?>
                            <small>
                                <?php if ($model->user_id != Yii::$app->user->id): ?>
                                    <i class="fa fa-user"></i> meet with <?= Html::a($model->user->profile->name ? $model->user->profile->name : $model->user->username, ['/u/' . $model->user->username]) ?>
                                <?php else: ?>
                                    <i class="fa fa-user"></i> meet with <?= Html::a($model->event->user->profile->name ? $model->event->user->profile->name : $model->event->user->username, ['/u/' . $model->event->user->username]) ?>
                                <?php endif ?>
                            </small>
                        </h2>
                    </div>
                    <div class="body text-center">
                        <h2>
                            <strong><?= date('H:i', $model->started_at) ?> - <?= date('H:i', $model->ended_at) ?></strong>
                        </h2>
                        <h4>
                            <?= date('d M Y', $model->started_at) ?>
                        </h4>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>