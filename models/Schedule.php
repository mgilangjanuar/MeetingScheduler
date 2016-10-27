<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "schedule".
 *
 * @property integer $id
 * @property integer $started_at
 * @property integer $ended_at
 * @property string $note
 * @property integer $event_id
 * @property integer $user_id
 *
 * @property User $user
 * @property Event $event
 */
class Schedule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['startedAtPretty', 'endedAtPretty', 'event_id'], 'required'],
            [['started_at', 'ended_at', 'event_id', 'user_id'], 'integer'],
            [['note'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'started_at' => 'Started At',
            'ended_at' => 'Ended At',
            'startedAtPretty' => 'Started At',
            'endedAtPretty' => 'Ended At',
            'note' => 'Note',
            'event_id' => 'Event ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->setStartedAt();
            $this->setEndedAt();
            return true;
        }
        return false;
    }

    public function getStartedAtPretty()
    {
        if ($this->started_at) {
            return date('d M Y H:i', $this->started_at);
        }
        return date('d M Y H:i');
    }

    public function getEndedAtPretty()
    {
        if ($this->ended_at) {
            return date('d M Y H:i', $this->ended_at);
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

    public function setStartedAt()
    {
        $this->started_at = strtotime($this->startedAtPretty);
    }

    public function setEndedAt()
    {
        $this->ended_at = strtotime($this->endedAtPretty);
    }

    public function isCanBook()
    {
        return time() + $this->event->can_book_before <= $this->started_at && ! $this->user_id;
    }

    public function cancel()
    {
        $this->user_id = null;
        $this->note = null;
        return $this->save();
    }

    public function book()
    {
        if ($this->isCanBook()) {
            foreach (Schedule::find()->where(['user_id' => Yii::$app->user->id, 'event_id' => $this->event_id])->all() as $model) {
                $model->cancel();
            }
            $this->user_id = Yii::$app->user->id;
        }
        return $this->save();
    }

    public function isOwner()
    {
        return $this->user_id == Yii::$app->user->id;
    }
}
