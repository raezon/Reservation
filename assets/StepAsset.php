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
class StepAsset extends AssetBundle
{
    //    public $sourcePath = '@bower/font-awesome';
    public $basePath = '@webroot';
    public $baseUrl = '@web'; // where assets are located

    public $css = [
        'css/site.css',
        'css/fullcalendar.min.css'
    ];
    public $js = [
        //'js/app.js',
        'js/js_treatements.js',
        'js/calendar.js',
        // 'js/slick.js',
        'js/moment.min.js',
        //'js/jquery.min.js',
        'js/fullcalendar.min.js',
        'js/send.js',
        //'js/fullcalendar.min.js'
        'js/OveridingUlceadMultipleInput.js'

    ];

    public $depends = [
        'yii\web\YiiAsset',
        //  'yii\bootstrap4\BootstrapPluginAsset', // it includes: 'yii\web\YiiAsset' & 'bootstrap4\BootstrapAsset'
        'yii\bootstrap\BootstrapAsset', //bootstrap3
        //        'yii\bootstrap4\BootstrapAsset', //bootstrap4
    ];
}
