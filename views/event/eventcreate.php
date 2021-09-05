<?php 
use Yii;
use app\models\base\Event;
use app\models\EventSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;


     $model = new Event();
        $model->created_date = $date;
        $model3 = new \app\models\forms\ServicesAndPriceForm();
        $model1 =  new \app\models\forms\GeneralInformationForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          

           return $this->redirect(Url::to(['welcome/step','id'=>2,'category_id'=>$category_id]))}
?>