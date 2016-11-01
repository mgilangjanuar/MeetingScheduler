<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property integer $can_book_before
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $user_id
 *
 * @property User $user
 * @property Schedule[] $schedules
 */
class Event extends \yii\db\ActiveRecord
{
    const DURATION_TO_MINUTE = 60;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'slug'], 'required'],
            [['description', 'slug'], 'string'],
            [['slug'], 'unique'],
            [['created_at', 'updated_at', 'user_id', 'can_book_before'], 'integer'],
            [['name'], 'string', 'max' => 255],
            // [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['slug'], 'match', 'pattern' => "/^([a-z0-9\-\_])+$/", 'not' => false, 'message' => 'Must be lowercase and not space or symbol.'],
            [['name', 'slug'], function ($attribute)
            {
                if (($this->$attribute) != (\yii\helpers\Html::encode($this->$attribute))) {
                    $this->setBookBefore();
                    $this->addError($attribute, 'This field contained forbidden character.');
                }
            }]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'slug' => 'Slug',
            'can_book_before' => 'Can Book Before (in minutes)',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'createdAtPretty' => 'Created At',
            'updatedAtPretty' => 'Updated At',
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
    public function getSchedules()
    {
        return $this->hasMany(Schedule::className(), ['event_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->setUserId();
            $this->setBookBefore();
            return true;
        }
        return false;
    }

    public function setBookBefore()
    {
        if ($this->can_book_before) {
            $this->can_book_before = $this->can_book_before * 60;
        }
    }

    public function getCanBookPretty()
    {
        return $this->can_book_before / 60;
    }

    public function setUserId()
    {
        $this->user_id = Yii::$app->user->id;
    }

    public static function findActive()
    {
        return Event::find()->where(['<', 'opened_at', time()])->andWhere(['>', 'closed_at', time()])->one();
    }

    public function isOwner()
    {
        return $this->user_id == Yii::$app->user->id;
    }

    public function getScheduleGroups($empty = false, $valid = false)
    {   
        $query = Schedule::find()->where(['event_id' => $this->id] + ($empty ? ['user_id' => null] : []));
        if ($valid) {
            $query = $query->andWhere(['>', 'started_at', (time() + ($this->can_book_before))]);
        }
        $schedules = $query->orderBy('started_at')->all();
        if ($schedules) {
            $results = [];

            $init = date('d M Y', $schedules[0]->started_at);

            foreach ($schedules as $model) {
                if (date('d M Y', $model->started_at) == $init) {
                    $results[strtotime($init)][] = $model;
                    $init = date('d M Y', $model->started_at);
                } else {
                    $init = date('d M Y', $model->started_at);
                    $results[strtotime($init)][] = $model;
                }
            }

            return $results;
        }
        return [];
    }

    public function getCreatedAtPretty()
    {
        return date('d M Y H:i', $this->created_at);
    }

    public function getUpdatedAtPretty()
    {
        return date('d M Y H:i', $this->updated_at);
    }
}
