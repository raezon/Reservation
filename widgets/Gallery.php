<?php

namespace app\widgets;

use Yii;

/**
 * Alert widget renders a message from session flash. All flash messages are displayed
 * in the sequence they were assigned using setFlash. You can set message as following:
 *
 * ```php
 * Yii::$app->session->setFlash('error', 'This is the message');
 * Yii::$app->session->setFlash('success', 'This is the message');
 * Yii::$app->session->setFlash('info', 'This is the message');
 * ```
 *
 * Multiple messages could be set as follows:
 *
 * ```php
 * Yii::$app->session->setFlash('error', ['Error 1', 'Error 2']);
 * ```
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @author Alexander Makarov <sam@rmcreative.ru>
 */
class Gallery extends \yii\bootstrap\Widget
{
    public $count;
    public $images;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        parent::run();
        //setting allias for images
        Yii::setAlias('@productImgUrl', 'img/products');
        $images_gallery='';
        //creation of the image galleries
        foreach ($this->images as $image) {
            $path = Yii::getAlias('@productImgUrl') . '/' . $image;
            $images_gallery .= '<img class="js-qv-product-cover img-fluid" style="height:520px" src=' . $path . '  alt="" title="" style="width:100%;" itemprop="image">';
           
        }

        return $images_gallery;
    }
}
