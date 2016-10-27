<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class EnvironmentController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionInit($message = 'hello world')
    {
        echo copy( __DIR__ . '/../environment/config/db.php', __DIR__ . '/../config/db.php') 
            ? 'Copying /environment/config/db.php to /config/db.php' 
                : '[Error] Something wrong, please check environment directory.';
        echo PHP_EOL . 'Done.' . PHP_EOL;
    }
}
