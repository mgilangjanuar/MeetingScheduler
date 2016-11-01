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
                        <h2 class="truncate"><?= $model->name ?></h2>
                    </div>
                    <div class="body">
                        <div class="panel-description">
                            <?= $model->description ?>
                        </div>
                        <small class="text-muted"><i class="fa fa-clock-o"></i> <?= $model->createdAtPretty ?></small>
                    </div>
                    <div class="card-overlay">
                        <div class="card-button-action">
                            <?= Html::a('<i class="material-icons">remove_red_eye</i>', ['/event/view', 'id' => $model->id], ['class' => 'text-info']) ?>
                            <?= Html::a('<i class="material-icons">mode_edit</i>', ['/event/update', 'id' => $model->id], ['class' => 'text-warning']) ?>
                            <?= Html::a('<i class="material-icons">delete</i>', ['/event/delete', 'id' => $model->id], [
                                'class' => 'text-danger',
                                'data' => [
                                    'confirm' => 'Are you sure?',
                                    'method' => 'post'
                                ]
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <div class="text-center">
        <?= Html::a('<i class="material-icons">add</i>', ['/event/create'], ['class' => 'btn btn-primary btn-circle-lg waves-effect waves-circle waves-float btn-float']) ?>
    </div>
</div>

<?php $this->registerJs(<<<Js
    $('.card').hover(function ()
    {
        $(this).addClass('blur')
        $(this).find('.card-overlay').addClass('show')
    }, function ()
    {
        $(this).removeClass('blur')
        $(this).find('.card-overlay').removeClass('show')
    })
Js
) ?>