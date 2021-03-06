<?php
/**
 * @link https://github.com/tigrov/intldata
 * @author Sergei Tigrov <rrr-r@ya.ru>
 */

namespace app\modules\location\intldata;

class Continent extends DataAbstract
{
    /**
     * Continent codes with ISO 3166-1 alpha-2 country codes
     */
    const CODES = [
        'AF' => ['BW','CF','BJ','AO','BI','BF','GM','CG','CV','DJ','DZ','ER','EH','GA','GN','GW','LR','LY','YT','LS',
                 'MA','ML','MR','MU','NA','NE','SZ','SC','RE','RW','SD','SN','SL','SO','SS','ST','TN','UG','ZA','ZM',
                 'SH','TD','TG','TZ','CI','CM','GH','KE','MZ','MW','NG','KM','EG','GQ','MG','ET','ZW','CD'],
        'AN' => ['BV','AQ','TF','HM','GS'],
        'AS' => ['AM','AZ','BN','BT','CC','CN','BD','BH','CX','GE','JP','KG','KW','LA','LB','IO','IR','IQ','JO','KZ',
                 'KH','ID','MO','MV','MM','MN','NP','OM','MY','SY','KP','PS','QA','SA','AF','PK','TM','TR','VN','UZ',
                 'TJ','YE','KR','LK','HK','IL','AE','IN','SG','TH','TW','PH'],
        'EU' => ['CH','BG','AX','AL','AT','BY','FI','GB','GG','CY','CZ','DK','ES','EE','FO','GI','XK','HU','HR','IM',
                 'IE','IS','IT','JE','NL','LI','LT','LV','MC','MD','MT','ME','SM','SE','PT','RO','SI','SJ','VA','AD',
                 'FR','NO','DE','GR','LU','MK','PL','RU','UA','BE','BA','RS','SK'],
        'NA' => ['BZ','BB','AI','BS','BL','BM','GP','CU','CW','DM','DO','CR','KN','GL','GT','HN','HT','JM','NI','MF',
                 'MX','MQ','MS','SV','SX','PR','PM','AW','US','VG','BQ','AG','TT','VI','LC','KY','CA','VC','GD','PA',
                 'TC'],
        'OC' => ['AS','AU','CK','FJ','FM','KI','GU','MH','NF','MP','NU','NR','NZ','PN','PW','PG','SB','TK','TL','TV',
                 'VU','UM','WF','NC','PF','WS','TO'],
        'SA' => ['BO','AR','CL','EC','FK','CO','GF','GY','SR','PE','PY','UY','VE','BR'],
    ];

    /**
     * Names of continents
     */
    const NAMES = [
        'AF' => 'Africa',
        'AN' => 'Antarctica',
        'AS' => 'Asia',
        'EU' => 'Europe',
        'NA' => 'North america',
        'OC' => 'Oceania',
        'SA' => 'South america',
    ];

    /**
     * @inheritdoc
     */
    public static function codes()
    {
        return array_keys(static::CODES);
    }

    /**
     * @inheritdoc
     */
    public static function name($code)
    {
        return static::NAMES[$code];
    }

    /**
     * Returns list of continent's ISO 3166-1 alpha-2 country codes
     * @param string|null $code continent code
     * @return array
     */
    public static function countryCodes($code = null)
    {
        return $code ? static::CODES[$code] : static::CODES;
    }

    /**
     * Returns continent code by ISO 3166-1 alpha-2 country code.
     * @param string $countryCode ISO 3166-1 alpha-2 country code
     * @return string|null
     */
    public static function countryContinentCode($countryCode)
    {
        foreach (static::CODES as $code => $countryCodes) {
            if (in_array($countryCode, $countryCodes)) {
                return $code;
            }
        }

        return null;
    }
}