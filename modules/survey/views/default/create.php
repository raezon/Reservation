<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 05/10/2017
 * Time: 14:24
 */

use kartik\editable\Editable;
use kartik\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $survey app\modules\survey\models\Survey */
/* @var $withUserSearch boolean */

$this->title = Yii::t('survey', 'Create new survey');


echo $this->render('_form', [
    'survey' => $survey,
    'withUserSearch' => $withUserSearch
]);

