<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot/themes/default';
    public $baseUrl = '@web/themes/default';
    public $css = [
        'css/roboto.min.css',
        'https://fonts.googleapis.com/icon?family=Material+Icons',
        'bootstrap/dist/css/bootstrap.min.css',
        'adminbsb-materialdesign/plugins/node-waves/waves.css',
        'adminbsb-materialdesign/css/style.css',
        'adminbsb-materialdesign/css/themes/theme-blue.min.css',
        'css/site.css',
    ];
    public $js = [
        'bootstrap/dist/js/bootstrap.min.js',
        'adminbsb-materialdesign/plugins/node-waves/waves.min.js',
        'adminbsb-materialdesign/js/admin.js',
        'moment/min/moment.min.js',
        'js/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        '\rmrevin\yii\fontawesome\AssetBundle',
    ];
}
