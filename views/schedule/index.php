<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Schedules';
?>

<div class="book-view">
    <div class="well container-main-title">
        <h1 class="main-title"><?= $this->title ?></h1>
    </div>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <?php if (! $models): ?>
                <p class="text-center not-set">you haven't schedule yet</p>
            <?php endif ?>
            <?php foreach ($models as $model): ?>
                <div class="card">
                    <div class="header text-center bg-deep-orange">
                        <h2 class="truncate">
                            <?= Html::a($model->event->name, ['/!/' . $model->event->slug], ['class' => 'not-style']) ?>
                            <small>
                                <i class="fa fa-user"></i> meet with <?= Html::a($model->event->user->profile->name ? Html::encode($model->event->user->profile->name) : Html::encode($model->event->user->username), ['/u/' . $model->event->user->username]) ?>
                            </small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <?= Html::a('<i class="material-icons">restore</i> Reschedule', ['/!/' . $model->event->slug]) ?>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <?= Html::a('<i class="material-icons">delete</i> Delete', ['/book/delete', 'id' => $model->id], [
                                            'data' => [
                                                'method' => 'post',
                                                'confirm' => 'Are you sure?',
                                            ]
                                        ]) ?>
                                    </li>
                                </ul>
                            </li>
                        </ul>
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