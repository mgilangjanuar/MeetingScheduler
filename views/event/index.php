<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Events';
?>
<div class="event-index">
    
    <div class="well container-main-title">
        <h1 class="main-title"><?= $this->title ?></h1>
    </div>

    <div class="row">
        <?php if (!$models): ?>
            <p class="text-center not-set">you haven't event yet</p>
        <?php endif ?>
        <?php foreach ($models as $model): ?>
            <div class="col-sm-6 col-md-4">
                <div class="card">
                    <div class="header">
                        <h2 class="truncate small"><?= $model->name ?></h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <?= Html::a('<i class="material-icons">remove_red_eye</i> View', ['/event/view', 'id' => $model->id], ['class' => 'text-info']) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('<i class="material-icons">mode_edit</i> Update', ['/event/update', 'id' => $model->id], ['class' => 'text-warning']) ?>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <?= Html::a('<i class="material-icons">delete</i> Delete', ['/event/delete', 'id' => $model->id], [
                                            'data' => [
                                                'confirm' => 'Are you sure?',
                                                'method' => 'post'
                                            ]
                                        ]) ?>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="panel-description">
                            <?= $model->description ?>
                        </div>
                        <small class="text-muted"><i class="fa fa-clock-o"></i> <?= $model->createdAtPretty ?></small>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <div class="text-center">
        <?= Html::a('<i class="material-icons">add</i>', ['/event/create'], ['class' => 'btn btn-primary btn-circle-lg waves-effect waves-circle waves-float btn-float']) ?>
    </div>
</div>