<?php
/**
 * @link https://github.com/tigrov/yii2-country
 * @author Sergei Tigrov <rrr-r@ya.ru>
 */

namespace app\modules\location\models;

use app\modules\location\ModelInterface;
use app\modules\location\IntldataTrait;
use app\modules\location\AllTrait;
use app\modules\location\CreateTrait;


use yii\base\BaseObject;

/**
 * Class Locale
 * @package location\country
 *
 * @property string $code locale code
 * @property string $name locale name
 * @property string $languageCode locale's ISO 639 language code
 * @property string $languageName locale's language name
 * @property Language $language locale's language
 * @method static string localeName(string $code) Returns name of a locale in the locale language
 * @method static array localeNames(string[] $codes = null, bool $sort = true) Returns list of locale names in the each locale language
 * @method static string acceptCode(string $header = null) Tries to find out best available locale based on HTTP “Accept-Language” header
 * @method static string languageCode(string $localeCode) Returns ISO 639-1 or ISO 639-2 language code for a locale
 * @method static string[] languageLocaleCodes(string $languageCode) Returns list of language locale codes
 * @method static array languagesLocaleCodes() Returns list of locale codes grouped by ISO 639-1, ISO 639-2 or ISO 639-3 language codes
 * @method static string[] countryLocaleCodes(string $countryCode) Returns list of country locale codes (using RFC 4646 language tags)
 * @method static array countriesLocaleCodes() Returns list of locale codes (using RFC 4646 language tags) grouped by ISO 3166-1 alpha-2 country codes
 * @method static string|null findMainCode(string[] $localeCodes) Find main locale code in a list
 * @method static string|null countryLocaleCode(string $countryCode) Tries to find locale code for a country
 * @method static string languageCountryLocaleCode(string $languageCode, string $countryCode) Returns locale code (using RFC 4646 language tags) for a language and a country
 */
class Locale extends BaseObject implements ModelInterface
{
    use IntldataTrait, CreateTrait, AllTrait;

    /**
     * @var string code of the locale
     */
    public $code;

    /**
     * @return string
     */
    public function getName()
    {
        return static::name($this->code);
    }

    /**
     * @return string
     */
    public function getLanguageCode()
    {
        return static::languageCode($this->code);
    }

    /**
     * @return string
     */
    public function getLanguageName()
    {
        return Language::name($this->getLanguageCode());
    }

    /**
     * @return Language
     */
    public function getLanguage()
    {
        return Language::create($this->getLanguageCode());
    }
    
}