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


    public function loginAsDemo() {
        $I = $this;
        if ($I->loadSessionSnapshot('demo')) {
            return;
        }

        $I->amOnPage('/login');

        $I->fillField('#email', 'i@liuchao.me');
        $I->fillField('#password', 'demo');

        $I->click('//*[@id="auth"]');
        $I->wait(3);
        $I->canSee('demo');

        $I->saveSessionSnapshot('demo');
    }


    public function loginAsLiupangzi() {
        $I = $this;
        if ($I->loadSessionSnapshot('liupangzi')) {
            return;
        }

        $I->amOnPage('/login');

        $I->fillField('#email', 'thesedays@126.com');
        $I->fillField('#password', '123456');

        $I->click('//*[@id="auth"]');
        $I->wait(3);
        $I->canSee('liupangzi');

        $I->saveSessionSnapshot('liupangzi');
    }
}
