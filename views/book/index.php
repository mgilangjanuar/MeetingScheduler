<?php 
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->name;
?>

<div class="book-index">
    <div class="well container-main-title">
        <h1 class="main-title"><?= $this->title ?></h1>
    </div>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="card text-center">
                <div class="body">
                    <?= $model->description ?>
                    <small>Managed by <i class="fa fa-user"></i> <?= Html::a($model->user->profile->name ? $model->user->profile->name : $model->user->username, ['/u/' . $model->user->username]) ?></small>
                </div>
            </div>
        </div>
    </div>

    <?php if ($model->getScheduleGroups(true, true)): ?>
        <div class="schedule">
            
            <div class="document-list">
                <ul class="list-inline">
                    <?php foreach ($model->getScheduleGroups(true, true) as $i => $schedule): ?>
                        <li class="document-item">
                            <div class="panel panel-default text-center">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?= date('D, d M Y', $i) ?></h3>
                                </div>
                                <div class="panel-body">
                                    <?php foreach ($schedule as $clock): ?>
                                        <?= Html::a(date('H:i', $clock->started_at) . ' - ' . date('H:i', $clock->ended_at), ['/book/create', 'id' => $clock->id], [
                                            'class' => 'btn btn-sm ' . ($clock->user_id ? 'btn-primary' : 'btn-default'),
                                        ]) ?>
                                        <br/>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>

        </div>
    <?php else: ?>
        <br /><br />
        <p class="not-set text-center">this event haven't schedule yet</p>
    <?php endif ?>
</div>