<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/fullcalendar.min.css'
    ];
    public $js = [
//'js/app.js',
        //'js/js_treatement.js',
        'js/calendar.js',
     //   'js/slick.js',
        'js/moment.min.js',

        'js/fullcalendar.min.js',
        'js/send.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
//        'yii\bootstrap4\BootstrapAsset',
    ];
}
