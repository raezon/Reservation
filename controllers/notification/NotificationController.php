<?php

namespace app\controllers\notification;

use app\models\User;
use app\widgets\Notifications;
use webzop\notifications\controllers\DefaultController as BaseController;
use webzop\notifications\helpers\TimeElapsed;
use Yii;
use yii\data\Pagination;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;

//use Da\User\Filter\AccessRuleFilter;

class NotificationController extends BaseController
{
    public $layout = "@app/views/layouts/main";

    protected $userId;
    public $user;

    public function init()
    {
        $this->userId = User::getCurrentUser()->id;
        $this->user = new User();

        parent::init();
    }
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                    'confirm' => ['post'],
                    'block' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,

                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                         
                                return true;
                           
                        },
                    ],

                ],
            ],
        ];
    }
    /**
     * Displays index page.
     *
     * @return string
     */
    public function actionIndex()
    {

        $user = User::getCurrentUser();

        if ($this->user->isPartner()) {

            $partner = \app\models\Partner::find()->where(['user_id' => \app\models\User::getCurrentUser()->id])->one();
            $query = (new Query())
                ->from('{{%notifications}}')
                ->innerJoin('reservation', 'reservation.id = notifications.reservation_id')
                ->andWhere(['reservation.status' => 0])
                ->andWhere(['reservation.partner_id' => $partner->id]);

        } else {
            if ($this->user->isUser()) {
                $query = (new Query())
                    ->from('{{%notifications}}')
                    ->innerJoin('reservation', 'reservation.id = notifications.reservation_id')
                    ->andWhere(['reservation.status' => 1])
                    ->andWhere(['reservation.user_id' => \app\models\User::getCurrentUser()->id])
                ;

            }
        }

        $pagination = new Pagination([
            'pageSize' => 20,
            'totalCount' => $query->count(),
        ]);

        $list = [];
        if ($query->count() > 0) {
            $list = $query
                ->orderBy(['notifications.id' => SORT_DESC])

                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        }

        $notifs = $this->prepareNotifications($list);

        return $this->render('@app/views/notification/default/index', [
            'notifications' => $notifs,
            'pagination' => $pagination,
        ]);
    }

    public function actionList()
    {

        if ($this->user->isPartner()) {
            $partner = \app\models\Partner::find()->where(['user_id' => \app\models\User::getCurrentUser()->id])->one();
            $list = (new Query())
                ->from('{{%notifications}}')
                ->innerJoin('reservation', 'reservation.id = notifications.reservation_id')
                ->andWhere(['reservation.status' => 0])
                ->andWhere(['reservation.partner_id' => $partner->id])
                ->limit(10)
                ->all();

        } else {
            if ($this->user->isUser()) {
                $list = (new Query())
                    ->from('{{%notifications}}')
                    ->innerJoin('reservation', 'reservation.id = notifications.reservation_id')
                    ->andWhere(['reservation.status' => 1])
                    ->andWhere(['reservation.user_id' => \app\models\User::getCurrentUser()->id])
                    ->limit(10)
                    ->all();

            }
        }

        $notifs = $this->prepareNotifications($list);
        $this->ajaxResponse(['list' => $notifs]);
    }

    public function actionCount()
    {
        $count = Notifications::getCountUnseen($this->user);
        $this->ajaxResponse(['count' => $count]);
    }

    public function actionRead($id)
    {
        Yii::$app->getDb()->createCommand()->update('{{%notifications}}', ['read' => true], ['id' => $id])->execute();

        if (Yii::$app->getRequest()->getIsAjax()) {
            return $this->ajaxResponse(1);
        }

        return Yii::$app->getResponse()->redirect(['/notifications/default/index']);
    }

    public function actionReadAll()
    {
        Yii::$app->getDb()->createCommand()->update('{{%notifications}}', ['read' => true])->execute();
        if (Yii::$app->getRequest()->getIsAjax()) {
            return $this->ajaxResponse(1);
        }

        Yii::$app->getSession()->setFlash('success', Yii::t('modules/notifications', 'All notifications have been marked as read.'));

        return Yii::$app->getResponse()->redirect(['/notifications/default/index']);
    }

    public function actionDeleteAll()
    {
        Yii::$app->getDb()->createCommand()->delete('{{%notifications}}')->execute();

        if (Yii::$app->getRequest()->getIsAjax()) {
            return $this->ajaxResponse(1);
        }

        Yii::$app->getSession()->setFlash('success', Yii::t('modules/notifications', 'Toutes les notifications ont été supprimées.'));

        return Yii::$app->getResponse()->redirect(['/notifications/default/index']);
    }

    private function prepareNotifications($list)
    {
        $notifs = [];
        $seen = [];
        foreach ($list as $notif) {
            if (!$notif['seen']) {
                $seen[] = $notif['id'];
            }
            $route = @unserialize($notif['route']);
            $notif['url'] = !empty($route) ? Url::to($route) : '';
            $notif['timeago'] = TimeElapsed::timeElapsed($notif['created_at']);
            $notifs[] = $notif;
        }

        if (!empty($seen)) {
            //    Yii::$app->getDb()->createCommand()->update('{{%notifications}}', ['seen' => true], ['id' => $seen])->execute();
            Yii::$app->getDb()->createCommand()->update('{{%notifications}}', ['seen' => true])->execute();
        }

        return $notifs;
    }

    public function ajaxResponse($data = [])
    {
        if (is_string($data)) {
            $data = ['html' => $data];
        }

        $session = \Yii::$app->getSession();
        $flashes = $session->getAllFlashes(true);
        foreach ($flashes as $type => $message) {
            $data['notifications'][] = [
                'type' => $type,
                'message' => $message,
            ];
        }

        return $this->asJson($data);
    }
}
