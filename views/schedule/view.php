<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = date('H:i', $model->started_at) . ' - ' . date('H:i', $model->ended_at);
?>

<div class="schedule-view">
    <div class="well container-main-title">
        <h1 class="main-title"><?= $this->title ?></h1>
    </div>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="card">
                <div class="body">

                    <label>Event Name</label>
                    <p><i class="fa fa-calendar"></i> <?= $model->event->name ?></p>
                    <br />

                    <label>Time</label>
                    <p><i class="fa fa-clock-o"></i> <?= date('H:i', $model->started_at) ?> - <?= date('H:i d M Y', $model->ended_at) ?></p>
                    <br />

                    <label>Booked By</label>
                    <p><i class="fa fa-user"></i> <?= $model->user_id ? (Html::a($model->user->username, ['/u/' . $model->user->username])) : '<span class="not-set">(not set)</span>' ?></p>
                    <br />

                    <label>Notes</label>
                    <div><?= $model->note ? $model->note : '<span class="not-set">(not set)</span>' ?></div>
                    <br />
                    
                </div>
            </div>
        </div>
    </div>

    <?= Html::a('<i class="material-icons">delete</i>', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger btn-circle-lg waves-effect waves-circle waves-float btn-float',
        'data' => [
            'confirm' => 'Are you sure?',
            'method' => 'post'
        ]
    ]) ?>
</div>