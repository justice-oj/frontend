<?php

namespace www\tests\acceptance;

use Faker\Factory;
use www\tests\AcceptanceTester;

class ProblemCest {
    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   AcceptanceTester $I
     * @throws \Exception
     */
    public function checkProblemDetail(AcceptanceTester $I) {
        $I->userDemoLogin();
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
        $I->userDemoLogin();
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
        $I->userDemoLogin();
        $I->amOnPage('/problem/discussions?problem_id=1');

        $I->clickWithLeftButton('#add_reply');
        $I->waitForElementVisible('#null', 3);

        $faker = Factory::create();
        $input = $faker->sentence;
        $I->pressKey('#reply > div.ql-editor.ql-blank', $input);
        $I->clickWithLeftButton('#add_reply');
        $I->wait(5);
        $I->canSee($input, '/html/body/div[2]/div[3]/div[1]');
    }


    public function checkProblemEditorial(AcceptanceTester $I) {
        $I->userDemoLogin();
        $I->amOnPage('/problem/editorial?problem_id=1');
        $I->canSee('To be done.');
    }
}