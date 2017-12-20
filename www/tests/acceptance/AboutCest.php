<?php

namespace www\tests\acceptance;

use www\tests\AcceptanceTester;

class AboutCest {
    public function checkPageAbout(AcceptanceTester $I) {
        $I->amOnPage('/about');

        $I->see('About Justice', 'body > div.ui.main.container > div > h2:nth-child(3)');
        $I->see('aUBsaXVjaGFvLm1l ');
    }
}