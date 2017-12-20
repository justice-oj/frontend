<?php

namespace www\tests\acceptance;

use www\tests\AcceptanceTester;

class UnauthCest {
    public function checkDeniedPages(AcceptanceTester $I) {
        $I->amOnPage('/problems');
        $I->wait(3);
        $I->canSeeInTitle('Justice PLUS - Login');

        $I->amOnPage('/submissions');
        $I->wait(3);
        $I->canSeeInTitle('Justice PLUS - Login');

        $I->amOnPage('/ranking');
        $I->wait(3);
        $I->canSeeInTitle('Justice PLUS - Login');

        $I->amOnPage('/settings');
        $I->wait(3);
        $I->canSeeInTitle('Justice PLUS - Login');

        $I->amOnPage('/notifications');
        $I->wait(3);
        $I->canSeeInTitle('Justice PLUS - Login');
    }
}