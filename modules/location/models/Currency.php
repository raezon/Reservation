<?php
/**
 * @link https://github.com/tigrov/yii2-country
 * @author Sergei Tigrov <rrr-r@ya.ru>
 */

namespace app\modules\location\models;

use app\modules\location\ModelInterface;
use app\modules\location\IntldataTrait;
use app\modules\location\CreateTrait;

use yii\base\BaseObject;

/**
 * Class Currency
 * @package location\country
 *
 * @property string $code ISO 4217 currency code
 * @property string $name currency name
 * @method static string[] mainCodes() Returns list of main ISO 4217 currency codes
 * @method static array allNames() Returns all supported currency names include old and not used
 * @method static string|null findMainCode(string[] $codes) Find main currency code in a list
 * @method static string countryCurrencyCode(string $countryCode) Returns ISO 4217 currency code for a country
 * @method static string countryCurrencySymbol(string $countryCode) Returns currency symbol for a country
 * @method static string currencySymbol(string $code = null) Returns currency symbol for a ISO 4217 currency code
 */
class Currency extends BaseObject implements ModelInterface
{
    use IntldataTrait, CreateTrait, AllTrait;

    /**
     * @var string code of the currency
     */
    public $code;

    /**
     * @return string
     */
    public function getName()
    {
        return static::name($this->code);
    }
}