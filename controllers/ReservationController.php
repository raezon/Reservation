<?php

namespace app\controllers;

use app\models\base\Partner;
use app\models\base\Payment;
use app\models\Reservation;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ReservationController implements the CRUD actions for Reservation model.
 */
class ReservationController extends Controller
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
//                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf', 'save-as-new', 'add-payment', 'add-reservation-detail'],
                        'roles' => [User::ROLE_ADMIN, User::ROLE_PARTNER, User::ROLE_USER],
                    ],
                    [
                        'allow' => false,
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Reservation models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (User::isPartner()) {
            $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
            $query = Reservation::find()->where(['partner_id' => $partner->id]);
        } else {
            if (User::isUser()) {
                $query = Reservation::find()->where(['user_id' => User::getCurrentUser()->id]);
            }
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reservation model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerPayment = new \yii\data\ArrayDataProvider([
            'allModels' => $model->payments,
        ]);
        $providerReservationDetail = new \yii\data\ArrayDataProvider([
            'allModels' => $model->reservationDetails,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerPayment' => $providerPayment,
            'providerReservationDetail' => $providerReservationDetail,
        ]);
    }

    /**
     * Creates a new Reservation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Reservation();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionViewPiece($id)
    {
        $model = Reservation::findOne($id);
        Yii::setAlias('@app', 'uploads/');
        // This will need to be the path relative to the root of your app.
        $filePath = '/web/uploads';
        // Might need to change '@app' for another alias
        $completePath = Yii::getAlias('@app/' . $model->piece_jointe . '.pdf');

        $this->redirect($completePath);
    }
    public function actionAccept($userId, $reservation_id)
    {
        $model = new Payment();
        $now = new \DateTime();
        $model->payment_date = $now->format('Y-m-d H:i:s');
        $model->reservation_id = $reservation_id;
        $model->amount = 0;

        if ($model->save()) {
            $model = \app\models\Reservation::find()->where(['id' => $reservation_id])->one();
            $model->status = 1;
            $model->user_id =(string)$userId ;
            $model->partner_id =(string)$model->partner_id ;
            $model->product_item_id =(string)$model->product_item_id ;
            if($model->update()){

            }else{
                print_r($model->errors);
                die();
            }
            return $this->redirect(['payment/index']);
        } else {
            print_r($model->errors);
            die();
        }
    }

    /**
     * Updates an existing Reservation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->request->post('_asnew') == '1') {
            $model = new Reservation();
        } else {
            $model = $this->findModel($id);
        }

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Reservation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    /**
     *
     * Export Reservation information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id)
    {
        $model = $this->findModel($id);
        $providerPayment = new \yii\data\ArrayDataProvider([
            'allModels' => $model->payments,
        ]);
        $providerReservationDetail = new \yii\data\ArrayDataProvider([
            'allModels' => $model->reservationDetails,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerPayment' => $providerPayment,
            'providerReservationDetail' => $providerReservationDetail,
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
            ],
        ]);

        return $pdf->render();
    }

    /**
     * Creates a new Reservation model by another data,
     * so user don't need to input all field from scratch.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @param type $id
     * @return type
     */
    public function actionSaveAsNew($id)
    {
        $model = new Reservation();

        if (Yii::$app->request->post('_asnew') != '1') {
            $model = $this->findModel($id);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('saveAsNew', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Reservation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reservation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reservation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }

    /**
     * Action to load a tabular form grid
     * for Payment
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddPayment()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Payment');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add') {
                $row[] = [];
            }

            return $this->renderAjax('_formPayment', ['row' => $row]);
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
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add') {
                $row[] = [];
            }

            return $this->renderAjax('_formReservationDetail', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
