<?php  

use kartik\growl\Growl;
?>

<?php foreach (Yii::$app->session->allFlashes as $type => $message): ?>
    <?= Growl::widget([
        'type' => $type,
        'title' => $type == 'danger' ? 'Oh snap!' : (ucfirst($type) . '!'),
        'body' => $message,
        'showSeparator' => true,
        'delay' => 0,
        'pluginOptions' => [
            'placement' => [
                'from' => 'top',
                'align' => 'right',
            ]
        ]
    ]) ?>
<?php endforeach ?>