<?php

namespace app\components;

use app\models\ProductItem;
use app\models\ProductItemSearch;
use app\models\ProductParent;
use Yii;
use yii\base\Component;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;
use yii\web\Session;

class FilterBien extends Component
{
    public $category;
    public $id;
    public $model;

    public function __construct($category,$id, $config = [])
    {
        //part setting session

        $this->model = new \app\models\forms\SearchForm();
        $session = Yii::$app->session;
        $session->open();

        $this->model->category = $category;
        $this->id = $id;
        $this->category = $category;

        parent::__construct($config);
    }

    //This is the methode that will be fire
    public function filtrerBien()
    {

        $query = $this->getPartnerId();
        $result = $this->sendingDataToSiteController($query);
        return ($result);
    }

    //This methode is used for getting all the partner Id
    public function getPartnerId()
    {
        $product = ProductItem::find()
        // ->andWhere(['>=', 'quantity', 1])
            ->andWhere(['id' => $this->id])
            ->One();
        $productParent = ProductParent::find()
        // ->andWhere(['>=', 'quantity', 1])
            ->andWhere(['id' => $product->product_id])
            ->One();

        if ($this->category == 1 or $this->category == 3 or $this->category != 8) {
            $query = ProductItem::find()
                ->andWhere(['product_id' => $productParent->id])
                ->all();

        } else {
            $query = ProductItem::find()
                ->andWhere(['>=', 'quantity', 1])
                ->andWhere(['product_id' => $productParent->id])
                ->all();
        }

        return $query;
    }

    public function sendingDataToSiteController($query)
    {

        if (!empty($query)) {

            $pages = new Pagination(['totalCount' => count($query)]);

            $searchModel = new ProductItemSearch();
            $dataProvider = new ArrayDataProvider([
                'allModels' => $query,
                'pagination' => [
                    'pageSize' => 3,

                ],
            ]);
            //
            $category = (int) $this->model->category;
            //creating the return array
            $value = array();
            //assigning the return array
            array_push($value, $this->model);
            array_push($value, $this->category);
            array_push($value, $dataProvider);
            array_push($value, $pages);
            array_push($value, $searchModel);
            array_push($value, '');
            array_push($value, $category);
            array_push($value, 0);

            return ($value);
        }
        if (empty($query)) {
            // die();
            $query = array();
            $pages = new Pagination(['totalCount' => count($query)]);
            $searchModel = new ProductItemSearch();
            $dataProvider = new ArrayDataProvider([
                'allModels' => $query,
                'pagination' => [
                    'pageSize' => 3,
                ],
            ]);
            $category = (int) $this->model->category;
            $value = array();
            array_push($value, $this->model);
            array_push($value, $this->category);
            array_push($value, $dataProvider);
            array_push($value, $pages);
            array_push($value, $searchModel);
            if (empty($this->active)) {
                array_push($value, 0);
            } else {
                array_push($value, '');
            }

            array_push($value, $category);
            array_push($value, 0);

            // die();
            return ($value);
        }
        $pages = new Pagination(['totalCount' => count($query)]);

        $searchModel = new ProductItemSearch();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $query,

            'pagination' => [
                'pageSize' => 3,

            ],
        ]);

        $category = (int) $this->model->category;
        //creating the return array
        $value = array();
        //assigning the return array
        array_push($value, $this->model);
        array_push($value, $this->value_category_serached);
        array_push($value, $dataProvider);
        array_push($value, $pages);
        array_push($value, $searchModel);
        array_push($value, $this->active);
        array_push($value, $category);
        array_push($value, 0);

        return ($value);
    }
}
