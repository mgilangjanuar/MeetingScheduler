<?php 
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->name;
?>

<div class="event-index">

    <div class="well container-main-title">
        <h1 class="main-title"><?= $this->title ?></h1>
    </div>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 text-center">
            <div class="card">
                <div class="body">
                    <?= $model->description ?>
                    <p class="truncate">
                        <i class="fa fa-link"></i> <?= Html::a(Url::to(['/!/' . $model->slug], true), ['/!/' . $model->slug]) ?>
                    </p>

                </div>
            </div>
        </div>
    </div>

    <br />
    <?php if ($model->getScheduleGroups()): ?>
        <div class="schedule">
            
            <div class="document-list">
                <ul class="list-inline">
                    <?php foreach ($model->getScheduleGroups() as $i => $schedule): ?>
                        <li class="document-item">
                            <div class="panel panel-default text-center">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?= date('D, d M Y', $i) ?></h3>
                                </div>
                                <div class="panel-body">
                                    <?php foreach ($schedule as $clock): ?>
                                        <?= Html::a(date('H:i', $clock->started_at) . ' - ' . date('H:i', $clock->ended_at), ['/schedule/view', 'id' => $clock->id], [
                                            'class' => 'btn btn-sm ' . ($clock->user_id ? 'btn-primary' : 'btn-default'),
                                        ]) ?>
                                        <br/>
                                    <?php endforeach ?>
                                </div>
                                <div class="panel-footer text-right">
                                    <?= Html::a('<i class="fa fa-trash"></i> Delete all', ['/schedule/bulk-delete', 'id' => $model->id, 'time' => $i], [
                                        'class' => 'text-danger',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this item?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </div>
                            </div>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>

        </div>
    <?php else: ?>
        <br /><br />
        <p class="not-set text-center">you haven't schedule yet</p>
    <?php endif ?>

    <?= Html::a('<i class="material-icons">add</i>', ['/schedule/create', 'id' => $model->id], ['class' => 'btn btn-primary btn-float btn-circle-lg']) ?>

</div>