<?php

use yii\helpers\Url;

class LoginCest
{
    public function ensureThatLoginWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->see('Login', 'h1');

        $I->amGoingTo('try to login with correct credentials');
        $I->fillField('input[name="LoginForm[username]"]', 'asma');
        $I->fillField('input[name="LoginForm[password]"]', 'asma');
        $I->sendPOST('welcome/index');
        $I->click('login-button');
        
        //$I->wait(2); // wait for button to be clicked
        $I->amOnPage(Url::toRoute('/welcome/index'));

    }
    public function ensureWelcomeWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/welcome/index'));
       
        $I->wait(15); // wait for button to be clicked


    }
}
