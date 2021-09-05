<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\Partner;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AccountNotification;
use app\models\ProductSearch;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf','available'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
       $searchModel = new ProductSearch();
        $id=User::getCurrentUser()->id;
        
        //feching dataProvicer from the user
        $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one( );

         $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->andwhere(['partner_category'=>1,'partner_id'=>$partner->id])
        ]);

        if(User::getCurrentUser()->id!=180){

             $this->layout = 'main2';
             $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->andwhere(['partner_id'=>$partner->id]),
        ]);
        }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
         if(User::getCurrentUser()->id!=180){
            
             $this->layout = 'main2';
            
        }

        $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
        $model = $this->findModel($id);
        $providerOptions = new \yii\data\ArrayDataProvider([
            'allModels' => $model->options,
        ]);
        $providerReservationDetail = new \yii\data\ArrayDataProvider([
            'allModels' => $model->reservationDetails,
        ]);
         if ( User::getCurrentUser()->id!=180) {
                    # code...
        $category_id=$partner->category_id;
      
        if($category_id==3){
           return $this->render('view', [
            'model' => $this->findModel($id),
            'providerOptions' => $providerOptions,
            'providerReservationDetail' => $providerReservationDetail,
        ]); 
       }
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerOptions' => $providerOptions,
            'providerReservationDetail' => $providerReservationDetail,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         if(User::getCurrentUser()->id!=180){
            
             $this->layout = 'main2';
            
        }

        $model = new Product();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
      public function actionAvailable(){

         if(User::getCurrentUser()->id!=180){
            
             $this->layout = 'main2';
            
        }

        return $this->render('available');
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

          if(User::getCurrentUser()->id!=180){
            
             $this->layout = 'main2';
        }

        $model = $this->findModel($id);

        if($model->status=="1")
        $model->status="1";
        else{
            $model->status="0";
        }
        if ($model->loadAll(Yii::$app->request->post()) ) {
            $model->picture=$model->image;
           
            $msg=array();
               $msg['type']=$model->product_type_id;
               $msg['option']=$model->product_option_id;
               $msg['partner_category']=$model->partner_category;
               $msg['name']=$model->name;
               $msg['description']=$model->description;
               $msg['picture']=$model->picture;
               $msg['price']=$model->price;
               $msg['number_people']=$model->number_people;
               $msg['quantity']=$model->quantity;
               $msg['duration']=$model->duration;
               if(!empty($model->productType->nom))
               $msg['product_type_id']=$model->productType->nom;
               else
                 $msg['product_type_id']="";
              ////////////////////////////////////////////////////
              if(!empty($model->productOption->name))
              $msg['product_option_id']=$model->productOption->name;
              else
                $msg['product_option_id']="";
               $msg['condition']=$model->condition;
               $msg['availability']=$model->availability;
               $msg['partner_id']=$model->partner_id;
               $msg['extra']=$model->extra;
               $msg['status']=$model->status;
               $msg['created_at']=$model->created_at;
               $msg['updated_at']=$model->updated_at;

               //sending a notifciation to the admin
               $user = User::find()->where(['id'=>1])->one();
               $msg[0]=$msg;
               $msg=json_encode($msg);
               $user = User::find()->where(['id'=>User::getCurrentUser()->id])->one();
        
               $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
                if ( User::getCurrentUser()->id!=1) {
                     AccountNotification::create(AccountNotification::KEY_UPDATE_PRODUCT,$msg,$user->username,
                        $partner->name)->send();
                }
             



            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
         if(User::getCurrentUser()->id!=180){
            
             $this->layout = 'main2';
        }

        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }
  


    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
    * Action to load a tabular form grid
    * for Options
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddOptions()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Options');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formOptions', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
    * Action to load a tabular form grid
    * for ReservationDetail
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddReservationDetail()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('ReservationDetail');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formReservationDetail', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
