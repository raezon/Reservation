<?php namespace partner;
use yii\helpers\Url;

class roomRentallCest
{
    // tests
    public function login(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->see('Login', 'h1');

        $I->amGoingTo('try to login with correct credentials');
        $I->fillField('input[name="LoginForm[username]"]', 'asma');
        $I->fillField('input[name="LoginForm[password]"]', 'asma');
        $I->click('login-button');
        $I->wait(2); // wait for button to be clicked
    }
}
