<?php 
use yii\helpers\Html;
use yii\helpers\Url;

$user = Yii::$app->user->identity;
?>

<section>
    <aside id="leftsidebar" class="sidebar">
        <?php if (! Yii::$app->user->isGuest): ?>
            <div class="user-info">
                <div class="image">
                    <?= Html::img($user->profile->getAvatarUrl(48), [
                        'class' => 'img-circle img-responsive img-center',
                    ]) ?>
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $user->profile->name ? $user->profile->name : $user->username ?></div>
                    <div class="email"><?= $user->email ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li class="<?= Yii::$app->controller->id == 'profile' && (Yii::$app->request->get('id') == null) ? 'active' : '' ?>">
                                <?= Html::a('<i class="material-icons">account_circle</i><span>My Profile</span>', ['/profile/view']) ?>
                            </li>
                            <li class="<?= Yii::$app->controller->id == 'settings' ? 'active' : '' ?>">
                                <?= Html::a('<i class="material-icons">settings</i><span>Settings</span>', ['/user/settings/profile']) ?>
                            </li>
                            <li role="seperator" class="divider"></li>
                            <li>
                                <?= Html::a('<i class="material-icons">lock_open</i><span>Logout</span>', ['/user/logout'], [
                                    'data' => [
                                        'method' => 'post'
                                    ]
                                ]) ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <?php if (Yii::$app->user->isGuest): ?>
                    <li class="<?= Yii::$app->controller->id == 'site' ? 'active' : '' ?>">
                        <?= Html::a('<i class="material-icons">home</i><span>Home</span>', ['/site/index'], ['class' => 'waves-effect waves-block']) ?>
                    </li>
                    <li class="<?= Yii::$app->controller->id == 'security' ? 'active' : '' ?>">
                        <?= Html::a('<i class="material-icons">lock</i><span>Log In</span>', ['/user/login'], ['class' => 'waves-effect waves-block']) ?>
                    </li>
                <?php else: ?>
                    <li class="<?= Yii::$app->controller->id == 'site' ? 'active' : '' ?>">
                        <?= Html::a('<i class="material-icons">dashboard</i><span>Dashboard</span>', ['/site/index'], ['class' => 'waves-effect waves-block']) ?>
                    </li>
                    <li class="<?= Yii::$app->controller->id == 'event' ? 'active' : '' ?>">
                        <?= Html::a('<i class="material-icons">event</i><span>Events</span>', ['/event'], ['class' => 'waves-effect waves-block']) ?>
                    </li>
                    <li class="<?= Yii::$app->controller->id == 'schedule' ? 'active' : '' ?>">
                        <?= Html::a('<i class="material-icons">schedule</i><span>Schedules</span>', ['/schedule'], ['class' => 'waves-effect waves-block']) ?>
                    </li>
                <?php endif ?>
            </ul>
        </div>
        <div class="legal">
            <div class="copyright">
                &copy; <?= date('Y') ?> <a href="#"><?= Yii::$app->name ?></a>.
            </div>
            <div class="version">
                
            </div>
        </div>
    </aside>
</section>