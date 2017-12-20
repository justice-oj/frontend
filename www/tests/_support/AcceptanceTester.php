<?php

namespace www\tests;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
 */
class AcceptanceTester extends \Codeception\Actor {
    use _generated\AcceptanceTesterActions;


    public function login() {
        $I = $this;
        if ($I->loadSessionSnapshot('login')) {
            return;
        }

        $I->amOnPage('/login');

        $I->fillField('#email', 'i@liuchao.me');
        $I->fillField('#password', 'demo');

        $I->click('//*[@id="auth"]');
        $I->wait(3);
        $I->canSee('demo');

        $I->saveSessionSnapshot('login');
    }
}
