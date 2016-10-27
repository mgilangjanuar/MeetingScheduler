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
use app\models\ScheduleMaster;

class ScheduleController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['view', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action)
                        {
                            return $this->findSchedule(Yii::$app->request->get('id'))->event->isOwner();
                        }
                    ],
                    [
                        'actions' => ['bulk-delete', 'create'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action)
                        {
                            return $this->findEvent(Yii::$app->request->get('id'))->isOwner();
                        }
                    ],
                    [
                        'actions' => ['index'],
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

    public function actionIndex()
    {
        return $this->render('index', [
            'models' => Schedule::find()->where(['user_id' => Yii::$app->user->id])->andWhere(['>', 'ended_at', time()])->orderBy('started_at')->all()
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findSchedule($id)
        ]);
    }

    public function actionCreate($id)
    {
        $model = new ScheduleMaster(['event' => $id]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/event/view', 'id' => $id]);
        }
        return $this->render('create', [
            'model' => $model,
            'event' => $this->findEvent($id)
        ]);
    }

    public function actionUpdate($id)
    {
        return $this->render('update');
    }

    public function actionDelete($id)
    {
        $callback = ['/event/view', 'id' => $this->findSchedule($id)->event_id];
        $this->findSchedule($id)->delete();
        return $this->redirect($callback);
    }

    public function actionBulkDelete($id, $time)
    {
        $event = $this->findEvent($id);
        if (isset($event->getScheduleGroups()[$time])) {
            foreach ($event->getScheduleGroups()[$time] as $model) {
                $model->delete();
            }
        }
        return $this->redirect(['/event/view', 'id' => $id]);
    }

    private function findEvent($id)
    {
        if ($model = Event::findOne($id)) {
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
