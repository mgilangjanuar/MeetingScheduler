<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\widgets\Pjax;

AppAsset::register($this);
\ercling\pace\PaceWidget::widget([
    'color'=>'red',
    'theme'=>'minimal',
    'options'=>[
        'ajax'=>['trackMethods'=>['GET','POST','AJAX']]
    ]
]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> - <?= Yii::$app->name ?></title>
        <?php $this->head() ?>
    </head>
    <body class="theme-blue">
        <?php $this->beginBody() ?>
        <div class="overlay"></div>
        <?php require '_partial/navbar.php' ?>
        <?php require '_partial/sidebar.php' ?>
        <section class="content">
            <div class="container-fluid">
                <?php require '_partial/breadcrumb.php' ?>
                <?php require '_partial/growl.php' ?>
                <?= $content ?>
            </div>
        </section>
        <?php $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']); ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
