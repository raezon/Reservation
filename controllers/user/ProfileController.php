<?php

namespace app\controllers\user;

use Yii;
use dektrium\user\controllers\ProfileController as BaseProfileController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;
use app\models\Partner;

class ProfileController extends BaseProfileController
{

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
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        //                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf', 'save-as-new'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return (User::isAdmin() || $this->isUserAuthor());
                        }

                    ],
                    //                    [
                    //                        'allow' => false
                    //                    ]
                ]
            ]
        ];
    }
    /**
     * Redirects to current user's profile.
     *
     * @return \yii\web\Response
     */
    public function actionIndex()
    {

        $this->layout = 'main2';
        //        $model = $this->finder->findProfileById(\Yii::$app->user->getId());
        //
        //        if ($model === null) {
        //            throw new NotFoundHttpException();
        //        }
        //
        //        return $this->render('index', [
        //            'model' => $model,
        //        ]);

        return $this->redirect(['show', 'id' => \Yii::$app->user->getId()]);
    }

    /**
     * Shows user's profile.
     *
     * @param int $id
     *
     * @return \yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionShow($id)
    {
        $this->layout = 'main2';
        $model = $this->finder->findProfileById($id);

        if ($model === null) {
            throw new NotFoundHttpException();
        }

        return $this->render('show', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = 'main2';
        //$model = $this->finder->findProfileById($id);
        $model = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['show', 'id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    protected function isUserAuthor()
    {
        return Yii::$app->request->get('id') == Yii::$app->user->id;
        //        return $this->finder->findProfileById(Yii::$app->request->get('id'))->user_id == Yii::$app->user->id;
    }
}
