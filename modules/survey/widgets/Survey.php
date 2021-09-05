<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 26/10/2017
 * Time: 10:09
 */

namespace app\modules\survey\widgets;


use app\modules\survey\models\SurveyStat;
use app\modules\survey\SurveyWidgetAsset;

use yii\db\Exception;
use yii\db\Expression;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class Survey extends \yii\base\Widget
{
    public $surveyId = null;
    public $nextUrl = null;

    public function init()
    {
        // set up i8n
        if (empty(\Yii::$app->i18n->translations['survey'])) {
            \Yii::$app->i18n->translations['survey'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@surveyRoot/messages',
            ];
        }

//        \Yii::setAlias('@surveyRoot', __DIR__);
        \Yii::setAlias('@surveyRoot', '@app/modules/survey');

        parent::init();
    }

    public function getViewPath()
    {
        return \Yii::getAlias('@surveyRoot/views');
    }

    public function beforeRun()
    {
//        $assignedModel = SurveyStat::getAssignedUserStat(\Yii::$app->user->getId(), $this->surveyId);
//        if (empty($assignedModel)) {
//            throw new ForbiddenHttpException();
//        }
        return parent::beforeRun();
    }

    public function run()
    {
        $view = $this->getView();
        SurveyWidgetAsset::register($view);

        $survey = $this->findModel($this->surveyId);
        if (!$survey || !$survey->isAccessibleByCurrentUser) {
	        return $this->renderUnavailable();
        }
        
        $status = $survey->getStatus();
        if ($status !== \app\modules\survey\models\Survey::STATUS_ACTIVE) {
            return $this->renderClosed();
        }

        $assignedModel = SurveyStat::getAssignedUserStat(\Yii::$app->user->getId(), $this->surveyId);
        if (empty($assignedModel)) {
            SurveyStat::assignUser(\Yii::$app->user->getId(), $this->surveyId);
            $assignedModel = SurveyStat::getAssignedUserStat(\Yii::$app->user->getId(), $this->surveyId);
        } else {
//            if ($assignedModel->survey_stat_is_done){
//                return $this->renderClosed();
//            }
        }

        if ($assignedModel->survey_stat_started_at === null) {
            $assignedModel->survey_stat_started_at = new Expression('NOW()');
            $assignedModel->save(false);
        }

        return $this->renderSurvey($this->surveyId, $assignedModel, $this->nextUrl);
    }

    private function renderClosed()
    {
        echo $this->render('@surveyRoot/views/widget/default/closed');
    }
    
    private function renderUnavailable()
    {
        echo $this->render('@surveyRoot/views/widget/default/unavailable');
    }
    
    private function renderSurvey($id, $stat, $nextUrl = null)
    {
        $survey = $this->findModel($id);
        echo $this->render('@surveyRoot/views/widget/default/index', [
            'survey' => $survey, 
            'stat' => $stat,
            'nextUrl' => $nextUrl,
            
        ]);
    }

    protected function findModel($id)
    {
        if (($model = \app\modules\survey\models\Survey::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}