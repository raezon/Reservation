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
 * @author Djeabla ammar<amardjebabala10@gmail.com>
 */
class Languages extends \yii\bootstrap\Widget
{

    public $Languages;
    public $categories;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        parent::run();
        if ($this->categories == 7) {


            //creation of the table corresponding for the extra
            //Switch case
            $Languages = json_decode($this->Languages);
            $languages = "";
            foreach ($Languages as $Language) {

                if ($Language) {

                    $languages .= "<div class='grid-item'><img src='img/logos_detail/languages/" . $Language . ".png' width='50px' height='50px'/></div>";
                }
            }

            return  '
                            <div class="grid-container">
                            </br>
                            ' . $languages . '
                            </div>
                        
                        ';
        }
    }
};
