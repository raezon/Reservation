<?php


class amarCest 
{
    public function _before(UnitTester $I)
    {
        session_abort();
    }

    public function _after(UnitTester $I)
    {
        session_abort();
    }

    // tests
    public function tryToTest(UnitTester $I)
    {
        session_abort();
        $I->comment('⚑ A simple way to display a message to the console ☺');
    }
}
