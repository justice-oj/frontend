<?php

namespace www\tests\acceptance;

use www\tests\AcceptanceTester;

class RankingCest {
    public function checkRankingList(AcceptanceTester $I) {
        $I->login();
        $I->amOnPage('/ranking');
        $I->canSee('Ranking', 'body > div.ui.main.container > h2');
    }
}