<?php

namespace www\tests\acceptance;

use www\tests\AcceptanceTester;

class RankingCest {
    public function checkRankingList(AcceptanceTester $I) {
        $I->userDemoLogin();
        $I->amOnPage('/ranking');

        $I->canSee('Ranking', 'h2');
    }
}