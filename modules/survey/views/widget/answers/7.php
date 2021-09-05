<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 10/10/2017
 * Time: 13:59
 */

use app\modules\survey\models\SurveyUserAnswer;
use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var $question app\modules\survey\models\SurveyQuestion */
/** @var $form \yii\widgets\ActiveForm */

$userAnswers = $question->userAnswers;

foreach ($question->answers as $i => $answer) {
//    $userAnswer = $userAnswers[$answer->survey_answer_id] ?? (new SurveyUserAnswer()); // PHP7
    $userAnswer = isset($userAnswers[$answer->survey_answer_id])? $userAnswers[$answer->survey_answer_id] : (new SurveyUserAnswer());

    echo $form->field($userAnswer, "[$question->survey_question_id][$answer->survey_answer_id]survey_user_answer_value")->input('text',
        ['placeholder' => \Yii::t('survey', 'Enter your answer here')])->label($answer->survey_answer_name);

    echo Html::tag('div', '', ['class' => 'clearfix']);
}