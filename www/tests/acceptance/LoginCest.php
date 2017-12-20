<?php

namespace www\tests\acceptance;

use www\tests\AcceptanceTester;

class LoginCest {
    public function _before(AcceptanceTester $I) {
        $I->amOnPage('/login');
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   AcceptanceTester $I
     * @throws \Exception
     */
    public function checkEmptyEmail(AcceptanceTester $I) {
        $I->click('//*[@id="auth"]');
        $I->waitForElementVisible('.small.modal', 3);
        $I->canSee('Please input your email address.', '#modal_content');
        $I->click('.ui.red.cancel.button');
        $I->waitForElementNotVisible('.small.modal', 3);
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   AcceptanceTester $I
     * @throws \Exception
     */
    public function checkEmptyPassword(AcceptanceTester $I) {
        $I->fillField('#email', 'wrong@email');

        $I->click('//*[@id="auth"]');
        $I->waitForElementVisible('.small.modal', 3);
        $I->canSee('Please input your password.', '#modal_content');
        $I->click('.ui.red.cancel.button');
        $I->waitForElementNotVisible('.small.modal', 3);
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   AcceptanceTester $I
     * @throws \Exception
     */
    public function checkWrongUserOrPassword(AcceptanceTester $I) {
        $I->fillField('#email', 'wrong@email');
        $I->fillField('#password', 'wrong password');

        $I->click('//*[@id="auth"]');
        $I->waitForElementVisible('.small.modal', 3);
        $I->canSee('user doesn\'t exist', '#modal_content');
        $I->click('.ui.red.cancel.button');
        $I->waitForElementNotVisible('.small.modal', 3);
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   AcceptanceTester $I
     * @throws \Exception
     */
    public function checkValidLogin(AcceptanceTester $I) {
        $I->fillField('#email', 'i@liuchao.me');
        $I->fillField('#password', 'demo');

        $I->click('//*[@id="auth"]');
        $I->wait(3);
        $I->canSee('Verdicts', 'h2');
        $I->canSee('demo', '.ui.right.floated.simple.dropdown.item');
    }
}