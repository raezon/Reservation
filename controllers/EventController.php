<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\TblEvents;
use app\models\Partner;
use app\models\User;

class EventController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
       
        return $this->renderPartial('calendar_view');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionAfficher()
    {
            
            $user_id=User::getCurrentUser()->id;
            $partner= Yii::$app->db->createCommand('SELECT * FROM partner WHERE user_id=:id')
           ->bindValue(':id', $user_id)
           ->queryone();
           // $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one(); 
            $id_partenaire=$partner['id'];
          
            $json = array();
            //seeting the sql code for getting the partner id 
            $events_model= Yii::$app->db->createCommand('SELECT * FROM tbl_events WHERE partner_id=:id ORDER BY id')
           ->bindValue(':id', $id_partenaire)
           ->queryAll();
            //contricting the json array
            $event_object=array();
            $eventsArray = array();
            //looping and constructing the array
            foreach ($events_model as $event_model) {
               // $event_object['color']='green';
                $event_object['title']=$event_model['title'];
                $event_object['partner_id']=$event_model['partner_id'];
                $event_object['start']=$event_model['start'];
                $event_object['end']=$event_model['end'];
                $event_object['color']='green';
                if($event_model['title']=='Absent') 
                     $event_object['color']='red';
                      array_push($eventsArray,$event_object);      
            }
            //the part for sending the json array
             $response = Yii::$app->getResponse();
             $response->getHeaders()->add('Content-Type', 'application/json;charset=utf-8');
             $response->content = json_encode($eventsArray);
             Yii::$app->end();
    
        
          
    }
    /**
     * Logout action.
     *
     * @return Response
     */
    public function delete_event()
    {
        
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function edit_event()
    {
       
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function add_event()
    {
        
    }
}
