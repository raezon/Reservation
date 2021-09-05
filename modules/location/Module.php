<?php

/**
 * @author    Ibrahim H.
 */

namespace app\modules\location;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\FormatConverter;

/**
 * Location module
 */
class Module extends \yii\base\Module
{
    /**
     * Current module name.
     */
    const MODULE = 'location';
    
    public $controllerNamespace = 'app\modules\location\controllers';
    
    public $locationTimezone;
    
    public $settings = [];
    
    public $saveSettings = [];

    /**
     * @var string the timezone for the displayed date. If not set, no timezone setting will be applied for formatting.
     * @see http://php.net/manual/en/timezones.php
     */
    public $displayTimezone;

    /**
     * @var string the timezone for the saved date. If not set, no timezone setting will be applied for formatting.
     * @see http://php.net/manual/en/timezones.php
     */
    public $saveTimezone;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->initSettings();
        parent::init();
    }

    /**
     * Initializes module settings.
     */
    public function initSettings()
    {
        $this->saveSettings += [
        ];
        $this->initAutoWidget();
    }

    /**
     * Initializes the autowidget settings.
     */
    protected function initAutoWidget()
    {
        
    }

    /**
     * Gets the display timezone.
     *
     * @return string
     */
    public function getDisplayTimezone()
    {
        if (!empty(Yii::$app->params['locationTimezone'])) {
            return Yii::$app->params['locationTimezone'];
        } elseif (!empty($this->locationTimezone)) {
            return $this->displayTimezone;
        } else {
            return null;
        }
    }

    /**
     * Gets the save timezone.
     *
     * @return string
     */
    public function getSaveTimezone()
    {
        if (!empty(Yii::$app->params['dateControlSaveTimezone'])) {
            return Yii::$app->params['dateControlSaveTimezone'];
        } elseif (!empty($this->saveTimezone)) {
            return $this->saveTimezone;
        } else {
            return null;
        }
    }

}