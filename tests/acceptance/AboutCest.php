<?php

use yii\helpers\Url;
use \Codeception\Util\Locator;

class AboutCest
{
    public function ensureThatAboutWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/about'));
        
        $I->see('>Qui somme nous?');
    }
}
