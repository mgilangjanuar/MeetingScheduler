<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * ScheduleMaster is the model behind the contact form.
 */
class ScheduleMaster extends Model
{
    public $startedAt;
    public $endedAt;
    public $duration; // in minutes
    public $event;

    const MAX = 20;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['startedAtPretty', 'endedAtPretty', 'duration', 'event'], 'required'],
            [['duration'], 'integer'],
            [['startedAtPretty', 'endedAtPretty'], function ($attribute)
            {
                if (($this->$attribute) != (\yii\helpers\Html::encode($this->$attribute))) {
                    $this->addError($attribute, 'This field contained forbidden character.');
                }
            }]
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'startedAt' => 'Started At',
            'endedAt' => 'Ended At',
            'startedAtPretty' => 'Started At',
            'endedAtPretty' => 'Ended At',
            'duration' => 'Duration (in minutes)',
            'event' => 'Event',
        ];
    }

    public function save()
    {
        $this->createMany();
        return true;
    }

    public function getEvent()
    {
        return Event::findOne($this->event);
    }

    public function getEventData()
    {
        $array = Event::find()->where(['user_id' => Yii::$app->user->id])->asArray()->all();
        return ArrayHelper::map($array, 'id', 'name');
    }

    public function getStartedAtPretty()
    {
        if ($this->startedAt) {
            return date('d M Y H:i', $this->startedAt);
        }
        return date('d M Y H:i');
    }

    public function getEndedAtPretty()
    {
        if ($this->endedAt) {
            return date('d M Y H:i', $this->endedAt);
        }
        return date('d M Y H:i');
    }

    public function setStartedAtPretty($time)
    {
        $this->startedAtPretty = $time;
    }

    public function setEndedAtPretty($time)
    {
        $this->endedAtPretty = $time;
    }

    public function getStartedAtUgly()
    {
        return strtotime($this->startedAtPretty);
    }

    public function getEndedAtUgly()
    {
        return strtotime($this->endedAtPretty);
    }

    public function timePrettyfier($time)
    {
        return date('d M Y H:i', $time);
    }

    public function getDurationInSecond()
    {
        return $this->duration * 60;
    }

    public function createMany()
    {
        $timestart  = $this->getStartedAtUgly();
        $timefinish = $this->getEndedAtUgly();
        $duration   = $this->getDurationInSecond();
        
        $i = 0;
        while ($timestart + $duration <= $timefinish) {
            $model             = new Schedule;
            $model->event_id   = $this->event;
            $model->started_at = $timestart;
            $model->ended_at   = $timestart + $duration;
            $model->save(false);

            $timestart += $duration;
            
            if (++$i > self::MAX) {
                return Yii::$app->session->setFlash('danger', 'Only allowed to create maximum '.self::MAX.' schedules at once.');
            }
        }
    }
}
