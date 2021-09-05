<?php

namespace app\modules\location\controllers;


use yii\db\Expression;

use Yii;
use yii\base\Model;
use yii\base\UserException;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\db\Query;

use app\modules\location\models\Country;
/**
 * Default controller for the `location` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($q = null, $info = null, $country_code = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        $data = [];
        switch ($info){
            case 'countries':
            $data = (new Query())->select(['id' => 'code', 'text'=> 'name_en'])
                    ->from('country')
                    ->andFilterWhere(['like', 'name_en', $q])
                    ->limit(20)
                    ->all();
                break;
            case 'cities':
                
            $data = (new Query())->select(['id' => 'geoname_id', 'text'=> 'name_en'])
                    ->from('city')
                    ->distinct()
                    ->andFilterWhere(['like', 'country_code', $country_code])
                    ->andFilterWhere(['like', 'name_en', $q.'%', false])
                    ->limit(20)
                    ->all();
                break;
            default :
                $data = [];
        }
        $out['results'] = array_values($data);
        return $out;
    }

    
}