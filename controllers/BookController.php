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

class BookController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action)
                        {
                            return $this->findSchedule(Yii::$app->request->get('id'))->isOwner();
                        }
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
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

    public function actionIndex($uname, $id = null)
    {
        $event = $id ? $this->findEvent($id) : $this->findDefaultEvent($uname);
        return $this->render('index', [
            'model' => $event
        ]);
    }

    public function actionCreate($id)
    {
        $model = $this->findSchedule($id);

        if (! $model->isCanBook()) {
            return $this->redirect(['/!/' . $model->event->user->username . '/' . $model->event->slug]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->book()) {
            Yii::$app->session->setFlash('success', 'Your schedule has been booked. Please check again and be on time.');
            return $this->redirect(['/schedule/index']);
        }
        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findSchedule($id);
        $model->cancel();
        return $this->redirect(['/schedule/index']);
    }

    public function findDefaultEvent($uname)
    {
        if ($model = Event::findOne(['user_id' => $this->findUser($uname)->id, 'is_default' => 1])) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function findUser($uname)
    {
        if ($model = User::findOne(['username' => $uname])) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function findEvent($id)
    {
        if ($model = Event::findOne(['slug' => $id])) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function findSchedule($id)
    {
        if ($model = Schedule::findOne($id)) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
