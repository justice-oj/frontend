<?php

namespace www\tests\acceptance;

use www\tests\AcceptanceTester;

class SubmissionsCest {
    public function checkPageSubmissions(AcceptanceTester $I) {
        $I->loginAsDemo();
        $I->amOnPage('/submissions');
        $I->canSee('Submissions', 'h2');
    }
}