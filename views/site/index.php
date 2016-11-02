<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Homepage';
?>
<div class="site-index">

    <div class="section section-1 text-center">
        <div class="middle">
            <div class="body">
                <h1 class="app-name">MeetApp</h1>
                <p class="lead">Meeting Scheduler Platform</p>
            </div>
        </div>
    </div>
    
    <div class="section section-2 text-center">
        <h1>About</h1>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Lol I'm lazy to create this f*cking section.
                </p>
            </div>
        </div>
    </div>

    <div class="section section-3 text-center">
        <div class="middle">
            <div class="body">
                <h3>Want to become a contributor?</h3>
                <p>
                    Just fork and create pull request on 
                </p>
                <p>
                    <?= Html::a('<i class="fa fa-github"></i> GitHub', 'http://github.com/mgilangjanuar/MeetingScheduler', ['class' => 'btn bg-black btn-sm waves-effect']) ?>
                </p>
            </div>
        </div>
    </div>

</div>
