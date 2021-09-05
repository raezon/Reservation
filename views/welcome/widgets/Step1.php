<?php

namespace app\views\welcome\widgets;

use yii\helpers\Html;
use borales\extensions\phoneInput\PhoneInput;
use yii\widgets\ActiveForm;


class Step1 extends \yii\web\Controller
{
    public static  $step1Array;
    public static  $title;
    public static  $form;
    public  function __construct($text)
    {
        //Intialiazing Title
        self::$title = $text;
    }
    public static  function beginingContainer()
    {
        echo '<div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h4>' . self::$title . '</h4>
                    </div>';
    }
    public static function begginingActiveForm()
    {
        self::$form = ActiveForm::begin([
            'id' => 'partner-registration-form',
            //      'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'method' => 'post',
            'action' => ['welcome/send']
        ]);
        echo Html::hiddenInput('category_id', \Yii::$app->request->get('category_id', 0));
    }
    public static function contentActiveForm($model, $category_id)
    {
        echo '<div class="row">';
        //Constructing the form
        $step1Array = array();
        $step1Array = ['idi', 'cat_id', 'firstName', 'lastName', 'tel', 'mobile', 'fax', 'email'];

        foreach ($step1Array as $filedElement) {
            switch ($filedElement) {
                case 'idi':
                    echo self::$form->field($model, $filedElement)->hiddenInput(['value' => 1])->label(false);
                    break;
                case 'cat_id':
                    echo self::$form->field($model, $filedElement)->hiddenInput(['value' => $category_id])->label(false);
                    break;
                case 'firstName':
                case 'lastName':
                case 'fax':
                case 'email':
                    echo "<div class='col-md-6'>";
                    echo   self::$form->field($model, $filedElement)->textInput();
                    echo "</div>";
                    break;
                case 'tel':
                case 'mobile':
                    echo "<div class='col-md-6'>";
                    echo self::$form->field($model, $filedElement)->widget(PhoneInput::className(), [
                        'jsOptions' => [
                            'preferredCountries' => ['no', 'pl', 'ua'],
                        ]
                    ], ['style' => 'width:500px']);
                    echo "</div>";
                    break;
            }
        }
        echo '</div>';
    }
    public static  function endingContainer()
    {
        echo "<div class='form-group'>
                <div class='pull-right'>";
        echo Html::submitButton('Next', ['class' => 'btn btn-lg btn-success', 'data-method' => 'POST']);

        echo "</div></div>";
    }
    public static function endingActiveForm()
    {
        ActiveForm::end();
    }
    public static function container($model, $category_id)
    {
        self::beginingContainer();
        self::begginingActiveForm();
        self::contentActiveForm($model, $category_id);
        self::endingContainer();
        self::endingActiveForm();
    }
}
