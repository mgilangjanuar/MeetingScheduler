<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Event;
use app\models\Schedule;
use yii\db\Query;
use yii\helpers\Url;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->render('index');
        } else {
            return $this->render('dashboard', [
                'models' => Schedule::find()
                    ->where(['>', 'ended_at', time()])
                    ->andWhere(['user_id' => Yii::$app->user->id])
                    ->orWhere(['event_id' => 
                        (new Query)->select('id')->from('event')->where(['user_id' => Yii::$app->user->id])
                    ])
                    ->andWhere(['is not', 'user_id', null])
                    ->orderBy('started_at')
                    ->all(),
            ]);
        }
    }
}
