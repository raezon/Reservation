<?php
/**
 * @link https://github.com/tigrov/yii2-country
 * @author Sergei Tigrov <rrr-r@ya.ru>
 */

namespace app\modules\location;

/**
 * Bootstrap class
 *
 * @author Sergei Tigrov <rrr-r@ya.ru>
 */
class Bootstrap implements \yii\base\BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\console\Application) {
            if (!isset($app->controllerMap['migrate'])) {
                $app->controllerMap['migrate']['class'] = 'yii\console\controllers\MigrationController';
            } elseif (is_string($app->controllerMap['migrate'])) {
                $app->controllerMap['migrate']['class'] = $app->controllerMap['migrate'];
            }
            $app->controllerMap['migrate']['migrationNamespaces'][] = 'location\migrations';
        }
    }
}