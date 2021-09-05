<?php

namespace app\widgets;

use yii\helpers\Html;
use yii\helpers\Url;
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
        //creation of the carousel indicateur
        $carousel_indicator = "";
        $images_gallery = "";
        $image_counter = 0;
        for ($i = 0; $i < $this->count; $i++) {
            if ($i == 0)
                $carousel_indicator .= '<li  data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>';
            else
                $carousel_indicator .= '<li style="margin-top:1200px;" data-target="#carouselExampleIndicators" data-slide-to="' . $i . '"></li>';
        }
        //creation of the image galleries
        foreach ($this->images as $image) {
            $path = Yii::getAlias('@productImgUrl') . '/' . $image;

            if ($image_counter == 0)
                $images_gallery .= '<div class="carousel-item active">
                                        <img class="d-block w-100" style="height:520px" src=' . $path . ' alt="First slide">
                                    </div>
                                   ';
            else
                $images_gallery .= '<div class="carousel-item ">
                                        <img class="d-block w-100" style="height:520px" src=' . $path . ' alt="First slide">
                                    </div>
                                    ';
            $image_counter++;
        }

        return  '
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
   
          <!--  <div class="carousel-inner  center" style="height:400px;">-->
          <div class="carousel-inner center" >
            ' .
            $images_gallery
            . '
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>';
    }
}
