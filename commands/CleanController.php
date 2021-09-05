<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\modules\survey\models\SurveyStat;
use app\modules\survey\models\SurveyUserAnswer;
use app\modules\survey\models\SurveyAnswer;

/**
 *
 * Clean unused data
 *
 */
class CleanController extends Controller
{
    /**
     * remove survey user answers
     */
    public function actionIndex()
    {
        try {
            SurveyStat::deleteAll();
            SurveyUserAnswer::deleteAll();
            echo "Cleaned.\n";    
        } catch (Exception $e) {
            echo $e->getMessage();
            return ExitCode::DATAERR;
        }

        return ExitCode::OK;
    }

    /**
     * remove survey answers
     */    
    public function actionAnswers()
    {
        try {
            SurveyAnswer::deleteAll();
            echo "Answers cleaned.\n";    
        } catch (Exception $e) {
            echo $e->getMessage();
            return ExitCode::DATAERR;
        }
        return ExitCode::OK;
    }
    
}
