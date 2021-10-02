<?php

namespace app\controllers;

use app\models\Partner;
use app\models\ProductItem;
use app\models\ProductItemSearch;
use app\models\ProductParent;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ProductItemController implements the CRUD actions for ProductItem model.
 */
class ProductItemController extends Controller
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
     * Lists all ProductItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $array_id_parent = array();
        if (User::getCurrentUser()->id == 180) {
            $array_id_parent;
            $query = ProductItem::find();
            $searchModel = new ProductItemSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $array_id_parent);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            $this->layout = 'main';
            $partner = Partner::find()->where(['user_id' => User::getCurrentUser()->id])->one();
            if (!empty($partner)) {
                $product_parent = ProductParent::find()->andwhere(['partner_id' => $partner->id])->all();

                foreach ($product_parent as $child) {
                    if (!empty($child->id)) {
                        $array_id_parent[] = $child->id;
                    }

                }
                //$query =ProductItem::find()->andwhere(['product_id'=>$array_id_parent])->one();

                $searchModel = new ProductItemSearch();
                if (!empty($array_id_parent)) {
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $array_id_parent);
                    return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
                } else {
                    $data = ProductItem::find()->andwhere(['product_id' => -1]);
                    $dataProvider = new ActiveDataProvider([
                        'query' => $data,
                        'pagination' => [
                            'pageSize' => 10,
                        ],
                        'sort' => [
                            'defaultOrder' => [
                                'created_at' => SORT_DESC,
                                'title' => SORT_ASC,
                            ],
                        ],
                    ]);

                    return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
                }
            }
        }
    }

    /**
     * Displays a single ProductItem model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        if (User::getCurrentUser()->id != 180) {
            $this->layout = 'main';
        }
        $product = ProductItem::find()->andwhere(['id' => $id])->one();

        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (User::getCurrentUser()->id != 180) {
            $this->layout = 'main';
        }
        $model = new ProductItem();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProductItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $expression = new Expression('NOW()');
        $now = (new \yii\db\Query)->select($expression)->scalar(); // SELECT NOW()
        $timestamp = strtotime($now);
        if (User::getCurrentUser()->id != 180) {
            $this->layout = 'main';
        }
        $model = ProductItem::find()->andwhere(['id' => $id])->one();
        $product = ProductItem::find()->andwhere(['id' => $id])->one();
        $product_parent = ProductParent::find()->andwhere(['id' => $model->product_id])->One();
        $model3 = new \app\models\forms\ServicesAndPriceForm();
        $product_parent_old = $product_parent;

        if ($model->loadAll(Yii::$app->request->post()) or $model3->load(Yii::$app->request->post())) {

            $string_data = '';

            if ($product->partner_category == 3) {
                $jsonData = array();

                $jsonData['vegan'] = $model->vegan;
                $jsonData['Vegetarian'] = $model->Vegetarian;
                $jsonData['Organic'] = $model->Organic;
                $jsonData['Gluten_free'] = $model->Gluten_free;
                $jsonData['Halal'] = $model->Halal;
                $jsonData['Cacher'] = $model->Cacher;
                $jsonData['Without_porc'] = $model->Without_porc;
                $string_data = json_encode($jsonData);
                $model->checkbox = $string_data;
            }

            if ($model->number_of_agent != 0) {
                $model->people_number = $model->number_of_agent;
            } else {
                $model->number_of_agent = 0;
            }

            $model->product_type = "";

            $product_parent->name = $product_parent->name;

            $product_parent->description = $product_parent->description;

            if (!empty($product_parent->kind_of_food)) {
                $product_parent->kind_of_food;
            } else {
                $product_parent->kind_of_food = "empty";
            }

            if (!empty($product_parent->min)) {
                $product_parent->min = $product_parent->min;
            } else {
                $product_parent->min = "empty";
            }

            $product_parent->picutre = "empty";

            if ($product_parent->saveAll()) {

            } else {
                echo 'ss';
                print_r($product_parent->errors);
                die();
            }

            $model->picture = $model->picture;
            if (!($_FILES['ProductItem']["name"]["image"] == "")) {

                $length = sizeof($_FILES['ProductItem']["name"]["image"]);

                $array_image = array();

                if ($_FILES['ProductItem']["name"]["image"][0]) {
                    for ($k = 0; $k < $length; $k++) {
                        $e = $_FILES['ProductItem']["name"]["image"][$k];
                        $type = $_FILES['ProductItem']["type"]["image"][$k];
                        $name = $_FILES['ProductItem']["tmp_name"]["image"][$k];
                        $extension = explode(".", $e);

                        $array_image[] = 'products' . $model->name . $k . $timestamp . '.' . $extension[1];
                        $extension = explode(".", $e);
                        $previous_array_image = $array_image;
                        $image = 'products' . $model->name . $k . $timestamp . '.' . $extension[1];
                        $images = json_encode($array_image, true);
                        $model->picture = (string) $images;
                        $model->image = (string) $images;
                        $reverse_image = json_decode($images, true);
                        $target = 'img/products/' . basename($image);
                        if (move_uploaded_file($name, $target)) {
                            $fp = fopen($target, "r");
                        }
                    }
                }
                if ($_FILES['ProductItem']["name"]["image"][0]) {
                    if ($extension[1] == 'jpg') {
                        if (file_exists('img/products/' . $model->picture)) {
                            unlink('img/products/' . $model->picture);
                        }

                    }
                    if ($extension == "png") {
                        $image = imagecreatefrompng($target);
                        $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
                        imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
                        imagealphablending($bg, true);
                        imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
                        imagedestroy($image);
                        $quality = 50; // 0 = low / smaller file, 100 = better / bigger file
                        imagejpeg($bg, $target . ".jpg", $quality);
                        imagedestroy($bg);
                        if (move_uploaded_file($bg, $target)) {
                            $fp = fopen($target, "r");
                        }
                    }
               
                    if (move_uploaded_file($name, $target) && $extension[1] = "jpg") {

                        $fp = fopen($target, "r");
                    }
                  }else{
                     $model->image="empty";
                     $model->picture=$model->picture;
                     
                  }
               
            }
            $model->status = 0;
            $model->picture=$model->picture;
            if ($model->saveAll()) {

            } else {
                echo "<pre>";
                print_r($model->errors);
                die();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('update', [
                'model' => $model,
                'product_parent' => $product_parent,
            ]);
        }
    }
    public function actionConfirm($id)
    {
        if (User::getCurrentUser()->id == 180) {
            $this->layout = 'main';
            $product = ProductItem::find()->andwhere(['id' => $id])->one();
            if ($product->status == 0) {
                $product->status = 1;
            } else {
                $product->status = 0;
            }

            if (empty($product->number_of_agent)) {
                $product->number_of_agent = 0;
            }

            if ($product->update()) {
            } else {
                print_r($product->getErrors());
                die();
            }
            return $this->redirect(['index']);
        } else {
            return $this->redirect(['index']);
        }
    }
    /**
     * Deletes an existing ProductItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (User::getCurrentUser()->id != 180) {
            $this->layout = 'main';
        }
        $parent = $this->findModel($id);
        $this->findModel($id)->deleteWithRelated();
        $this->findModelParent($parent->product_id)->deleteWithRelated();

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => true];
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findModelParent($id)
    {
        if (($model = ProductParent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
