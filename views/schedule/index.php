<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Schedules';
?>

<div class="book-view">
    <h1 class="main-title"><?= Html::encode($this->title) ?></h1>
    <br /><br />

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <?php if (! $models): ?>
                <p class="text-center not-set">you haven't schedule yet</p>
            <?php endif ?>
            <?php foreach ($models as $model): ?>
                <div class="card">
                    <div class="header text-center bg-light-blue">
                        <h2 class="truncate">
                            <?= Html::a($model->event->name, ['/!/' . $model->event->user->username . '/' . $model->event->slug], ['class' => 'not-style']) ?>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <?= Html::a('<i class="fa fa-refresh"></i> Reschedule', ['/!/' . $model->event->user->username . '/' . $model->event->slug]) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('<i class="fa fa-trash"></i> Delete Schedule', ['/book/delete', 'id' => $model->id], [
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