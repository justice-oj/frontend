<?php

namespace www\tests\acceptance;

use www\tests\AcceptanceTester;

class AboutCest {
    public function checkPageAbout(AcceptanceTester $I) {
        $I->amOnPage('/about');

        $I->see('About Justice', 'body');
        $I->see('aUBsaXVjaGFvLm1l ');
    }
}