<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Event;
use app\models\Schedule;
use dektrium\user\models\User;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionView($id = null)
    {
        return $this->render('view', [
            'model' => $this->findUser($id ? $id : Yii::$app->user->identity->username)
        ]);
    }

    private function findUser($username)
    {
        if ($model = User::findOne(['username' => $username])) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
