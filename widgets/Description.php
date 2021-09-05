<?php

namespace app\widgets;

use yii\helpers\Html;
use yii\helpers\Url;
use Yii;
use app\widgets\Description as WidgetsDescription;

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
 * @author Djeabla ammar<amardjebabala10@gmail.com>
 */
class Description
{
    static $height = 180;
    public static function incrementHeightDependingOnNumberOfFooter($product_parent)
    {

        if ($product_parent->partner_category == 1) {

            self::$height = self::$height + 135;
        } else {
            self::$height = self::$height + 50;
        }
        if ($product_parent->partner_category == 3) {
            self::$height = self::$height + 85;
        }
        if ($product_parent->partner_category == 4) {
            self::$height = self::$height + 85;
        }
        if ($product_parent->partner_category == 5) {

            self::$height = self::$height + 55;
        }
        if ($product_parent->partner_category == 6 or $product_parent->partner_category == 7) {

            self::$height = self::$height + 100;
        }

        if ($product_parent->partner_category == 2 or $product_parent->partner_category == 9) {

            self::$height = self::$height + 100;
        }
    }
    public static function footerLogoCategorie($product_parent, $product, $cancelation)
    {

        if ($product_parent->partner_category == 3) {

            echo '<div class="card-footer" ><span class="headerColorFooter" style=";font-size:14px;font-weight:bold;">Minimum price to place this order : </span><span style="font-size:14px;">' .$product->min_price. "€</span></div>";
            echo '<div class="card-footer" ><span class="headerColorFooter" style="font-size:14px;font-weight:bold;padding-top:10px;">People Number : </span><span style="font-size:14px;">' .  $product->people_number  . ' </span></div>';
        }
        if ($product_parent->partner_category == 4) {
            $camera = json_decode($product->checkbox);


            if ($camera->photo1) {
                echo '<div class="card-footer" ><span class="headerColorFooter" style="font-size:14px;font-weight:bold;">Services priced by hour : </span><span style="font-size:14px;">Photo</span></div>';
                echo '<div class="card-footer" ><span class="headerColorFooter" style="font-size:14px;font-weight:bold;">Description  photo : </span><span style="font-size:14px;">'.$product->description.'</span></div>';
            }

            if ($camera->video1) {
                echo '<div class="card-footer" ><span class="headerColorFooter" style=";font-size:14px;font-weight:bold;">Services priced by hour : </span><span style="font-size:14px;">Video</span></div>';
                echo '<div class="card-footer" ><span class="headerColorFooter" style="font-size:14px;font-weight:bold;">Description  video : </span><span style="font-size:14px;">'.$product->description.'</span></div>';
            }

            if ($camera->photo1andvideo) {
                echo '<div class="card-footer" ><span class="headerColorFooter" style=";font-size:14px;font-weight:bold;">Services priced by hour : </span><span style="font-size:14px;">Photo qnd video</span></div>';
                echo '<div class="card-footer" ><span class="headerColorFooter" style="font-size:14px;font-weight:bold;">Description  photo and video : </span><span style="font-size:14px;">'.$product->description.'</span></div>';
            }

            if ($camera->photo2) {
                echo '<div class="card-footer" ><span class="headerColorFooter" style=";font-size:14px;font-weight:bold;">Services priced by half day : </span><span style="font-size:14px;">Photo</span></div>';
                echo '<div class="card-footer" ><span class="headerColorFooter" style="font-size:14px;font-weight:bold;">Description  photo : </span><span style="font-size:14px;">'.$product->description.'</span></div>';
            }

            if ($camera->video2) {
                echo '<div class="card-footer" ><span class="headerColorFooter" style=";font-size:14px;font-weight:bold;">Services priced by half day : </span><span style="font-size:14px;">Video</span></div>';
                echo '<div class="card-footer" ><span class="headerColorFooter" style="font-size:14px;font-weight:bold;">Description  video : </span><span style="font-size:14px;">'.$product->description.'</span></div>';
            }

            if ($camera->photo2andvideo) {
                echo '<div class="card-footer" ><span class="headerColorFooter" style=";font-size:14px;font-weight:bold;">Services priced by half day : </span><span style="font-size:14px;">Photo</span></div>';
                echo '<div class="card-footer" ><span class="headerColorFooter" style="font-size:14px;font-weight:bold;">Description  photo and video: </span><span style="font-size:14px;">'.$product->description.'</span></div>';
            }
           
        }

        if ($product_parent->partner_category == 1) {

            $RoomRental = json_decode($product->product_type, true);
            echo '<div class="card-footer" ><span class="headerColorFooter" style="font-size:14px;font-weight:bold;padding-top:10px;">Area : </span><span style="font-size:14px;">' .  $RoomRental[0]["area"] . ' </span>m<sup>2</sup></div>';
            echo '<div class="card-footer" ><span class="headerColorFooter" style="font-size:14px;font-weight:bold;padding-top:10px;">Accaumodiation capcity : </span><span style="font-size:14px;">' .  $product->people_number  . ' </span></div>';
        }
        if ($product_parent->partner_category == 5) {

            echo '<div class="card-footer" ><span class="headerColorFooter" style="font-size:14px;font-weight:bold;padding-top:10px;">Duration by hour : </span><span style="font-size:14px;">' .  $product->periode  . ' </span></div>';
        }
        if ($product_parent->partner_category == 6) {
            $title = "Number of agents";
            if ($product_parent->partner_category == 7) $title = "Number of Host/Hostess";
            echo '<div class="card-footer" ><span class="headerColorFooter" style="font-size:14px;font-weight:bold;padding-top:10px;">Duration in hour : </span><span style="font-size:14px;">' .  $product->periode  . ' </span></div>';
            echo '<div class="card-footer" ><span class="headerColorFooter" style="font-size:14px;font-weight:bold;padding-top:10px;">' . $title . ' : </span><span style="font-size:14px;">' .  $product->number_of_agent  . ' </span></div>';
        }
        if ($product_parent->partner_category == 7) {

            if ($product_parent->partner_category == 7) $title = "Number of Host/Hostess";
            echo '<div class="card-footer" ><span class="headerColorFooter" style="font-size:14px;font-weight:bold;padding-top:10px;">Duration in hour : </span><span style="font-size:14px;">' .  $product->periode  . ' </span></div>';
            echo '<div class="card-footer" ><span class="headerColorFooter" style="font-size:14px;font-weight:bold;padding-top:10px;">' . $title . ' : </span><span style="font-size:14px;">' .  $product->number_of_agent  . ' </span></div>';
        }
        if ($product_parent->partner_category == 9) {
            echo '<div class="card-footer" style="padding-top:10px;"><span class="headerColorFooter" style="font-size:14px;font-weight:bold;padding-top:10px;"> 
            Quantity : </span><span style="font-size:14px;">' .  $product->quantity  . ' </span></div>';
            echo '<div class="card-footer" ><span class="headerColorFooter" style="font-size:14px;font-weight:bold;padding-top:10px;">Duration in hour : </span><span style="font-size:14px;">' .  $product->periode  . ' </span></div>';
        }
        if ($product_parent->partner_category == 2) {
            echo '<div class="card-footer" style="padding-top:10px;"><span class="headerColorFooter" style="font-size:14px;font-weight:bold;padding-top:10px;"> 
            Quantity of the equipment : </span><span style="font-size:14px;">' .  $product->quantity  . ' </span></div>';
            echo '<div class="card-footer" ><span class="headerColorFooter" style="font-size:14px;font-weight:bold;padding-top:10px;">Rental period by hour : </span><span style="font-size:14px;">' .  $product->periode  . ' </span></div>';
            echo '<div class="card-footer" ><span class="headerColorFooter" style="font-size:14px;font-weight:bold;padding-top:10px;">People Number : </span><span style="font-size:14px;">' .  $product->people_number  . ' </span></div>';
        }
        echo ' <div class="card-footer" ><span class="headerColorFooter" style="font-size:14px;font-weight:bold;padding-top:10px;">Cancellation accepted : </span><span style="font-size:14px;">' . $cancelation . ' </span></div>';
    }
    public static function Description($product_parent, $product, $cancelation)
    {
        $description = $product_parent->description;
        self::incrementHeightDependingOnNumberOfFooter($product_parent);
        echo  '
                <div class="card" style="background-color:#fffffff;;border-radius:0px;height:' . self::$height . 'px;margin-left:170px;margin-top:40px;width:75%;">
                    <div class="card-header text-center headerColor bg-gray" >
                           <span style="padding-bottom:10px"> <b>Description</b></span>
                    </div>
                    <div class="card-body" style="padding:50px;">
                        <div class="scrollable ">
                        <p class="card-text">' . $description . '</p>
                        </div>
                    </div>';

        self::footerLogoCategorie($product_parent, $product, $cancelation);
        echo '</div>';

        //   
    }
};
