<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 10/10/2017
 * Time: 13:37
 */

/** @var $question app\modules\survey\models\SurveyQuestion */
/** @var $form \yii\widgets\ActiveForm */

echo $this->render('@surveyRoot/views/widget/answers/' . $question->survey_question_type, ['question' => $question, 'form' => $form]);