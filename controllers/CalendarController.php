<?php

namespace app\controllers;

use Yii;
use app\models\base\Event;
use app\models\EventSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
/**
 * EventController implements the CRUD actions for Event model.
 */
class CalendarController extends Controller
{
    Public $layout = false;
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Event models.
     * @return mixed
     */

    public function actionCalendar(){
         $this->layout = false;
         echo "string";
        return $this->renderAjax('calendar', [
            ]);
    }
    public function actionCreate1($date,$category_id)
    {
        $model = new Event();
        $model->id=rand(10,100);
        $model->title="indisponible";
        $model->description="indisponible";
        $model->created_date = $date;
        if ($model->save()) {
          
         echo "string";
           
            
            $this->layout = false;
        /*return $this->renderAjax('calendar', [
                
            ]);*/

        } 
        else {
                             echo "SAVE";
                              echo "MODEL NOT SAVED other";
                              print_r( $model->getAttributes());
                              print_r( $model->getErrors());
                              exit;
                          } 
    }

}