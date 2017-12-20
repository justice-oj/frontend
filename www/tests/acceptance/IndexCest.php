<?php

namespace www\tests\acceptance;

use www\tests\AcceptanceTester;

class IndexCest {
    public function checkPageIndex(AcceptanceTester $I) {
        $I->amOnPage('/');

        $I->see('Verdicts', 'body > div.ui.main.container > div > div:nth-child(7) > h2');
        $I->see('In solitude, be a multitude to yourself.');

        $I->seeLink('Problems', '/problems');
        $I->seeLink('Login', '/login');
        $I->seeLink('About', '/about');
    }
}