<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Create Schedules';
?>

<div class="schedule-create">
    <div class="well container-main-title">
        <h1 class="main-title"><?= $this->title ?></h1>
    </div>

    <div class="form">
        <?= $this->render('_partial/form', [
            'model' => $model
        ]) ?>
    </div>

</div>