<?php

namespace www\tests\acceptance;

use www\tests\AcceptanceTester;

class ProblemCest {
    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   AcceptanceTester $I
     * @throws \Exception
     */
    public function checkProblemDetail(AcceptanceTester $I) {
        $I->login();
        $I->amOnPage('/problem?problem_id=1');
        $I->canSee('Time Limit: 1000 ms');

        $I->click('#submit');
        $I->waitForElementVisible('#null', 3);
        $I->wait(3);

        $I->clickWithLeftButton('.ui.dropdown.selection');
        $I->pressKey('.ui.dropdown.selection', 'J');
        $I->pressKey('.ui.dropdown.selection', ['enter']);
        $I->click('#submit');
        $I->wait(5);

        $I->canSee('Enter your code here. Read input from STDIN. Print output to STDOUT');
        $I->canSee('In Queue');
        $I->canSee('N/A');
        $I->canSee('Java');
    }


    public function checkProblemSubmissions(AcceptanceTester $I) {
        $I->login();
        $I->amOnPage('/problem/submissions?problem_id=1');
        $I->canSee('demo', 'body > div.ui.main.container > table > tbody > tr:nth-child(1)');
        $I->canSee('Java', 'body > div.ui.main.container > table > tbody > tr:nth-child(1)');
        $I->canSee('In Queue', 'body > div.ui.main.container > table > tbody > tr:nth-child(1)');
        $I->canSee('N/A', 'body > div.ui.main.container > table > tbody > tr:nth-child(1)');
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   AcceptanceTester $I
     * @throws \Exception
     */
    public function checkProblemDiscussions(AcceptanceTester $I) {
        $I->login();
        $I->amOnPage('/problem/discussions?problem_id=1');

        $I->click('#add_reply');
        $I->waitForElementVisible('#null', 3);

        $I->pressKey('#reply > div.ql-editor.ql-blank', 'abcd');
        $I->clickWithLeftButton('#add_reply');

        $I->wait(5);
        $I->canSee('abcd', 'body > div.ui.main.container > div.ui.large.comments');

        $I->click('body > div.ui.main.container > div.ui.large.comments > div:nth-child(2) > div > div.metadata > div.rating > i');
        $I->waitForElementVisible('#tip');
        $I->canSee('vote failed', '#tip_desc');
        $I->click('.ui.primary.button.ok');
        $I->waitForElementNotVisible('#tip');
    }


    public function checkProblemEditorial(AcceptanceTester $I) {
        $I->login();
        $I->amOnPage('/problem/editorial?problem_id=1');
        $I->canSee('To be done.');
    }
}