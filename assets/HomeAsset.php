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
class HomeAsset extends AssetBundle
{
//    public $sourcePath = '@bower/font-awesome';
    public $basePath = '@webroot';
    public $baseUrl = '@web'; // where assets are located
    
    public $css = [
        'css/style.css',
        'css/app.css',
        'css/clicango_theme.css',
        'css/fullcalendar.min.css',

    ];
    public $js = [
//      'https://code.jquery.com/jquery-3.2.1.slim.min.js', // use YiiAsset instead
      'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js',
//      'js/bootstrap.min.js', // added by $depends
      //'https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js',
      'https://unpkg.com/aos@2.3.1/dist/aos.js',

        'notifications.js'

    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset', // it includes: 'yii\web\YiiAsset' & 'bootstrap4\BootstrapAsset'
      // 'yii\bootstrap\BootstrapAsset', //bootstrap3
   //     'yii\bootstrap4\BootstrapAsset', //bootstrap4
    ];
}
