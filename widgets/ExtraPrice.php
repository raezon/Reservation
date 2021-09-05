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
class ExtraPrice extends \yii\bootstrap\Widget
{
    public $Extra;
    public $count;
    public $product_item;
    public $product_parent;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        parent::run();

        //creation of the table corresponding for the extra
        $table_rows = "";
        $index = -1;
        foreach ($this->Extra as $element) {
            $index++;
            $table_rows .= '<tr >
                                <td>
                                    <div class="custom-control custom-checkbox">
                                
                                    <input value="' . $index . '" ng-click="AdditionalPrice(' . $index . ',' . $this->product_parent . ')" type="checkbox" class="custom-control-input" id="customCheck' . $index . '" >
                                    <input   type="checkbox" class="custom-control-input">
                                        <label class="custom-control-label" for="customCheck' . $index . '"></label>
                                 
                                    </div>
                                </td>
                                <td style="color:#000;font-size:12px;font-weight:bold;">' . $element['Description'] . '
                                </td>
                                <td style="color:#000;font-size:12px;font-weight:bold;">' .  str_replace(",", "", $element['Price']) . '€' . '
                                </td>
                                    
            </tr>
            ';
        }


        if ($this->Extra[0]['Description'])
            return  '
        <div class="card" style="background-color:#ffffff;border-radius:0px;margin-left:170px;margin-top:40px;width:75%;margin-bottom: 50px;">
        <div class="card-header text-center headerColor bg-gray">
                <b>Additional  services</b>
        </div>
        <div class="card-body">
                <table class="table table-striped table-sm">
                <thead class="bg-gray">
                <tr>
                    <th  style="color:#f7c33f;font-size:13px;width:20%;">Select Option</th>
                    <th  style="color:#f7c33f;font-size:13px;width:60%;">Service Name</th>
                    <th  style="color:#f7c33f;font-size:13px;width:20%;">Serivce Price</th>
                </tr>
                </thead>
                <tbody  style="background-color:#efe302;"  >' .
                $table_rows
                . '

                </tbody>
                </table>
        </div>
    </div>
        ';
    }
}
