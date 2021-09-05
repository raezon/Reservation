<?php

namespace app\modules\api;

/**
 * onco module definition class
 */
class Module extends \yii\base\Module
{
    public $defaultController = 'user';
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
