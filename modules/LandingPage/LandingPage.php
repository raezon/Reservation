<?php

namespace app\modules\LandingPage;

/**
 * LandingPage module definition class
 */

use yii\web\Controller;
use Yii;
use yii\filters\AccessControl;
use yii\web\Response;

class LandingPage extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\LandingPage\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->params['foo'] = 'bar';
        $this->params['bsVersion'] = '3.x';
        $this->params['bsVersion'] = '4.x';

        // initialize the module with the configuration loaded from config.php
        // \Yii::configure($this, require('C:/xampp/htdocs/mainrepo_old/config' . '/web.php'));
    }
}
