<?php

namespace app\models;

use dektrium\user\Finder;
use dektrium\user\helpers\Password;
use Yii;
use yii\base\Model;
use dektrium\user\traits\ModuleTrait;
use dektrium\user\models\LoginForm as BaseLoginForm;

/**
 * LoginForm get user's login and password, validates them and logs the user in. If user has been blocked, it adds
 * an error to login form.
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class LoginForm extends BaseLoginForm
{

    /** @inheritdoc */
    public function rules()
    {
        $result = parent::rules();
        $result['passwordValidate'][1] = function ($attribute) {
            if ($this->user === null || !$this->validate($this->password, $this->user->password_hash)) {
                $this->addError($attribute, Yii::t('user', 'Invalid login or password'));
            }
        };
        return $result;
    }

    public function validatePassword($password, $hash)
    {
        return Yii::$app->security->validatePassword($password, $hash);
    }
}
