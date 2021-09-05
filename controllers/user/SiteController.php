<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\partner\RegistrationForm;
use app\models\User;
use app\models\Partner;
use app\models\Product;
use app\modules\survey\models\SurveyStat;
use app\models\PartnerCategorySurveys;
use app\models\Surveys;
use app\models\base\QuestionsList;
use app\models\base\Questions;
use app\models\base\QuestionsPartner;
use app\models\AccountNotification;

class SiteController extends Controller {

//    public $defaultAction = 'login';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        // for Access Control checkout: https://github.com/dektrium/yii2-user/blob/master/docs/custom-access-control.md
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'home';
        $this->setBsVersion('4.x');
        return $this->render('index');
    }

 public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/welcome/index']);
            //return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
        
    public function actionTerms() {
//        if (Partner::findOne(['user_id' => User::getCurrentUser()->id])){
//            echo 'exists';
//        } else {
//            echo 'not found';
//        }
//        die('');
        return $this->render('terms');
    }
    
    public function actionDisclaimer() {
        return $this->render('disclaimer');
    }

    public function actionFeatures() {
        $this->layout = 'home';
        return $this->render('features');
    }

/*    public function actionBecomePartner() {
        $this->setBsVersion(4);
        $user = new RegistrationForm();
        $partner = new Partner();
        $post = Yii::$app->request->post();
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($user->load($post) && $partner->load($post)) {
                $user->api_key = \Yii::$app->security->generateRandomString(16);
                $partner->status = 0;
                if ($user->validate()){
                    $user = $user->register();
                    if ($user){
                        $user->refresh();
                        $user->addRole(User::ROLE_PARTNER);
                        $partner->user_id = $user->id;
                        if (!$partner->validate() || !$partner->save()){
                            if ($transaction->isActive){
                                $transaction->rollBack();
                            }                            
                            Yii::$app->session->setFlash('warning', Yii::t('app',$partner->errors));
                        }
                        
                    } else {
                        if ($transaction->isActive){
                            $transaction->rollBack();
                        }
                        Yii::$app->session->setFlash('warning', Yii::t('app',$user->errors));
                    }
                } else {
                    Yii::$app->session->setFlash('warning', Yii::t('app',$user->errors));
                    if ($transaction->isActive){
                        $transaction->rollBack();
                    }
                    return $this->render('partner', [
                        'partner' => $partner,
                        'user' => $user
                    ]);
                }
                Yii::$app->session->setFlash('info',Yii::t('user',
                    'Your account has been created and a message with further instructions has been sent to your email')
                );
                if ($transaction->isActive){
                    $transaction->commit();
                }
                return $this->redirect(['/user/security/login']);
            }
        } catch (\Exception $e) {
            if ($transaction->isActive){
                $transaction->rollBack();
            }
            \Yii::warning($e->getMessage());
            throw $e;
        }
        return $this->render('partner', [
            'partner' => $partner,
            'user' => $user
        ]);
    }*/
    
    public function actionBecomePartner() {
        $this->setBsVersion(4);
        $user = new RegistrationForm();
        $post = Yii::$app->request->post();
        if ($user->load($post)){
            $user->api_key = \Yii::$app->security->generateRandomString(16);
            if ($user->validate()){
                $user = $user->register();
                if ($user){
                    $user->refresh();
                    $user->addRole(User::ROLE_PARTNER);
//                    $partner->user_id = $user->id; // will do that later
//                    if (!$partner->validate() || !$partner->save()){
//                        if ($transaction->isActive){
//                            $transaction->rollBack();
//                        }                            
//                        Yii::$app->session->setFlash('warning', Yii::t('app',$partner->errors));
//                    }
                    Yii::$app->session->setFlash('info',Yii::t('user',
                        'Your account has been created and a message with further instructions has been sent to your email')
                    );
//                    if ($transaction->isActive){
//                        $transaction->commit();
//                    }
                    $user = User::find()->where(['id'=>1])->one();

                    AccountNotification::create(AccountNotification::KEY_RESET_PASSWORD,
                        AccountNotification::KEY_NEW_ACCOUNT,
                     ['user' =>$user])->send();
                    return $this->redirect(['/user/security/login']);                    
                } else {
//                    if ($transaction->isActive){
//                        $transaction->rollBack();
//                    }
                    Yii::$app->session->setFlash('warning', Yii::t('app',$user->errors));
                } // !($user)
                
            } // $user->validate()
            
        }
        return $this->render('partner', [
            'user' => $user
        ]);
    }    
    
/*    protected function getPartnerSurveys($partnerId, $title) {
        $category = Partner::findOne(['user_id' => $partnerId])->category;
        $partnerCategorySurvey = PartnerCategorySurveys::find(['title' => $title, 'partner_category_id' => $category->id])->one();
        $partnerSurveys = Surveys::find(['partner_category_surveys_id' => $partnerCategorySurvey->id])
                ->orderBy(['survey_order' => SORT_ASC ])->all();
        return $partnerSurveys;
    }
*/
    
/*    public function actionWelcome($id = 0) {
        // in case someone try to access direct link
        if (!User::isPartner()){
            return $this->redirect(['site/index']);
        }
       
        $partnerSurveys = $this->getPartnerSurveys(User::getCurrentUser()->id,
            strtolower($this->action->id) );
//        $survey_route = $this->action->id; // welcome
//        $survey_route = $this->action->controller->module->requestedRoute; // site/welcome

        if ($id < count($partnerSurveys)){
            
            $partnerSurvey = $partnerSurveys[$id];
            // Redirect to next survey if this one is completed
            if ($this->surveyCompleted( $partnerSurvey->survey_id )){
                return $this->redirect(['/site/welcome', 'id' => $id+1]);
            }
            
            $survey = \app\modules\survey\widgets\Survey::widget([
                'surveyId' => $partnerSurvey->survey_id,
                'nextUrl' => Url::to(['/site/welcome', 'id' => $id+1]),
            ]);
            
            return $this->render('welcome', [
                'survey' => $survey
            ]);
        }
        return $this->redirect(['/site/index']);
    }
*/    
    protected function surveyCompleted($id) {
        $stat = SurveyStat::findOne([
            'survey_stat_survey_id' => $id, 
            'survey_stat_user_id' => \Yii::$app->user->getId()
        ]);
        return ($stat !== null && $stat->survey_stat_is_done);
    }    
    
    /**
     * 
     * @param type $version 4 or 3
     */
    protected function setBsVersion($version) {
        if ($version == 4){
            $this->layout = 'home';
            Yii::$app->params['bsVersion'] = '4.x';
        } else {
            $this->layout = 'main';
            Yii::$app->params['bsVersion'] = '3.x';
        }
    }

    public function actionPartner($id) {
        $this->setBsVersion(4);
        if (($model = Partner::findOne($id)) !== null) {
            return $this->render('partner_view', ['model' => $model]);
        }        
        
    } 
       public function actionProduct($id) {
        $this->setBsVersion(4);
        if (($model = Product::findOne($id)) !== null) {
            return $this->render('product_view', ['model' => $model]);
        }        
        
    }       
}
