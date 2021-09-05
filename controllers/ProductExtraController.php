<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Product;
use app\models\ProductParent;
use app\models\Partner;
use app\models\User;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;

/**
 * ProductExtraController implements the CRUD actions for ProductExtra model.
 */
class ProductExtraController extends Controller
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
                ];
    }

    /**
     * Lists all ProductExtra models.
     * @return mixed
     */
    public function actionIndex()
    {
          if(User::getCurrentUser()->id!=180){
             $this->layout = 'main2';
            
       
        }
        
         $searchModel = new ProductSearch();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
         
         $query = new  yii\db\Query;
         $query =  Product::find()->andwhere(['partner_id'=>$partner->id])->all();
         $query1 =  ProductParent::find()->all();
         $query_all=array();
         
         //construction the json array 
         
         foreach ($query  as $q) {
            
            if(!empty($q->extra))
             $query_all[]=json_decode($q->extra,true);

         }
         foreach ($query1  as $q) {
            
            if(!empty($q->extra))
             $query_all[]=json_decode($q->extra,true);

         }
         
         
         
         
         $provider = new ArrayDataProvider([
      'allModels' => $query_all,
      'pagination' => [
         'pageSize' => 3,
      ],
      'sort' => [
         'attributes' => ['id', 'name'],
      ],
   ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $provider,
            'model'=>  $query1
        ]);
    }

    /**
     * Displays a single ProductExtra model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
             if(User::getCurrentUser()->id!=180){
             $this->layout = 'main2';
            
       
        }
        return $this->render('view'
        );
    }

    /**
     * Creates a new ProductExtra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
            if(User::getCurrentUser()->id!=180){
             $this->layout = 'main2';
            
       
        }
        $model = new ProductExtra();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProductExtra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
            if(User::getCurrentUser()->id!=180){
             $this->layout = 'main2';
            
       
        }
        $model =  Product::find()->andwhere(['id'=>$id])->One();
        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProductExtra model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelet($id)
    {
           if(User::getCurrentUser()->id!=180){
             $this->layout = 'main2';
            
       
        }
        $model =  Product::find()->andwhere(['id'=>$id])->One();
     
        $array=array();
        $array['Description']="vide";
        $array['Quantity']="vide";
        $array['Price']="vide";
        $array[]=$array;
        $compressed=json_encode($array,true);
        $model->extra=$compressed;
        $model->status="0";

        if($model->update()){

        }else{
            echo "XD";
            print_r($model->getErrors());
            die();
            
        }

         $model =  ProductParent::find()->andwhere(['id'=>$id])->One();
         if(!empty($model))
         {
             $model->extra="";
             $model->update();
         }

    
      
          if(User::getCurrentUser()->id!=1){
             $this->layout = 'main2';
            
       
        }
       

        return $this->redirect(['index']);
    }
    
    /**
     * 
     * Export ProductExtra information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_CORE,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }

    
    /**
     * Finds the ProductExtra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductExtra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductExtra::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
