<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Event;

class EventController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['update', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action)
                        {
                            return $this->findEvent(Yii::$app->request->get('id'))->isOwner();
                        }
                    ],
                    [
                        'actions' => ['index', 'create'],
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
            'models' => Event::find()->where(['user_id' => Yii::$app->user->id])->all()
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findEvent($id)
        ]);
    }

    public function actionCreate()
    {
        $model = new Event;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findEvent($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'model' => $model
        ]);
    }

    public function actionDelete($id)
    {
        $this->findEvent($id)->delete();
        return $this->redirect(['index']);
    }

    private function findEvent($id)
    {
        if ($model = Event::findOne($id)) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
