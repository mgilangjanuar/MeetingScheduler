<?php
namespace app\controllers\user;

use dektrium\user\controllers\SecurityController as BaseSecurityController;
use dektrium\user\Finder;
use dektrium\user\models\Account;
use dektrium\user\models\LoginForm;
use dektrium\user\models\User;
use dektrium\user\Module;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use Yii;
use yii\authclient\AuthAction;
use yii\authclient\ClientInterface;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use dektrium\user\models\RegistrationForm;

use SSO\SSO;

class SecurityController extends BaseSecurityController
{

    /** @inheritdoc */
    public function behaviors()
    {
        $result = parent::behaviors();
        $result['access']['rules'][0]['actions'][] = 'login-sso-ui';
        return $result;
    }

    public function actionLoginSsoUi()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        SSO::authenticate();
        $user = SSO::getUser();

        if (User::findOne(['username' => $user->username]) == null) {
            $model              = new User;
            $model->username    = $user->username;
            $model->email       = $user->username . '@ui.edu';
            $model->password    = $user->npm . floor(time() / 10);
            $model->flags       = 550;
            if (! $model->save()) {
                return $this->redirect(['/user/login']);
            }
        }
        
        $modelUser = User::findOne(['username' => $user->username]);

        /** @var LoginForm $model */
        $model = Yii::createObject(LoginForm::className());
        $model->login = $user->username;
        $model->password = $user->npm . floor($modelUser->created_at / 10);

        if ($model->login()) {
            return $this->goBack();
        }
    }

    public function actionLogout()
    {
        $flag = Yii::$app->user->identity->flags;

        $event = $this->getUserEvent(Yii::$app->user->identity);

        $this->trigger(self::EVENT_BEFORE_LOGOUT, $event);

        Yii::$app->getUser()->logout();

        $this->trigger(self::EVENT_AFTER_LOGOUT, $event);

        if ($flag == 550) {
            return $this->redirect('https://sso.ui.ac.id/cas2/logout');
        }
        return $this->goHome();
    }
}