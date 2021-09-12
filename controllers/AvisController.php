<?php

namespace app\controllers;

class AvisController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
         } else {
            return $this->render('create', [
               'model' => $model,
            ]);
         }
    }

}
