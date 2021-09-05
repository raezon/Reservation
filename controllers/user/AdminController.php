<?php

namespace app\controllers\user;

use Yii;
use dektrium\user\controllers\AdminController as BaseAdminController;
use yii\filters\VerbFilter;
use app\models\User;
use yii\web\NotFoundHttpException;

/*
 * By default only 'admin' can access to this controller
 */
class AdminController extends BaseAdminController
{
/*    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
//                'only' => ['index', 'view', 'create', 'update', 'delete', 'pdf', 'save-as-new', 'add-product', 'add-subscription'],
                'rules' => [
                    [
                        'allow' => true,
//                        Omitting the actions means all actions.
//                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf', 'save-as-new', 'add-product', 'add-subscription'],
//                        'roles' => ['@'],
//                        'matchCallback' => function ($rule, $action) {
//                            return (User::isAdmin() || $this->isUserAuthor());
//                        }                        
                        'roles' => [User::ROLE_ADMIN]
                    ],
                    [
                        'allow' => false
                    ]
                ],
//                'denyCallback' => function ($rule, $action) {
//                    throw new \Exception('You are not allowed to access this page');
//                }                
            ]
        ];
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function isUserAuthor()
    {   
        return $this->findModel(Yii::$app->request->get('id'))->id == Yii::$app->user->id;
    }
*/
    
//    public function actionCreate()
//    {
//        // do your magic
//    }
}
