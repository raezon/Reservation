<?php
/**
 * @link https://github.com/tigrov/yii2-country
 * @author Sergei Tigrov <rrr-r@ya.ru>
 */

namespace app\modules\location;

use yii\base\BaseObject;

/**
 * Class Continent
 * @package location\country
 *
 * @property string $code continent code
 * @property string $name continent name
 * @property string[] $countryCodes list of continent's ISO 3166-1 alpha-2 country codes
 * @property array $countryNames list of continent's country names
 * @property Country[] $countries list of continent's countries
 * @method static array countryCodes(string $code = null) Returns list of continent's ISO 3166-1 alpha-2 country codes
 * @method static string|null countryContinentCode(string $countryCode) Returns continent code by ISO 3166-1 alpha-2 country code
 */
class Continent extends BaseObject implements ModelInterface
{
    use IntldataTrait, CreateTrait, AllTrait;

    /**
     * @var string code of the continent
     */
    public $code;

    /**
     * @var array list of continent's countries
     */
    private $_countries;

    /**
     * @return string
     */
    public function getName()
    {
        return static::name($this->code);
    }

    /**
     * List of continent's country codes.
     *
     * @return string[] country codes of the continent
     */
    public function getCountryCodes()
    {
        return static::countryCodes($this->code);
    }

    /**
     * List of continent's country names.
     *
     * @return array country names of the continent
     */
    public function getCountryNames()
    {
        return array_intersect_key(Country::names(), array_flip($this->countryCodes));
    }

    /**
     * List of continent's countries.
     *
     * @return Country[] countries of the continent
     */
    public function getCountries()
    {
        if ($this->_countries === null) {
            $this->_countries = [];
            foreach ($this->countryCodes as $countryCode) {
                $this->_countries[$countryCode] = Country::create($countryCode);
            }
        }

        return $this->_countries;
    }
}