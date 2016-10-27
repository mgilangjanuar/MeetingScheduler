<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

var_dump(Yii::$app->controller->id);
?>

<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="#" class="bars" style="display:block"></a>
            <?= Html::a(Yii::$app->name, Yii::$app->homeUrl, ['class' => 'navbar-brand']) ?>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><?= Html::a('<span class="date"></span> &nbsp;&nbsp;<i class="fa fa-clock-o"></i> <span class="time"></span>', '#', ['class' => 'nav-time']) ?></li>
                <?php if (! Yii::$app->user->isGuest): ?>
                    <li class="active">
                        <?= Html::a(Html::img(Yii::$app->user->identity->profile->getAvatarUrl(18), [
                            'class' => 'img-rounded',
                        ]).' ' . Yii::$app->user->identity->username, ['/profile/view']) ?>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>