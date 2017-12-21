<?php

namespace www\tests\acceptance;

use Facebook\WebDriver\WebDriverKeys;
use Faker\Factory;
use www\tests\AcceptanceTester;

class ProblemCest {
    public function checkProblemDetail(AcceptanceTester $I) {
        $I->loginAsDemo();
        $I->amOnPage('/problem?problem_id=1');

        $I->canSee('Time Limit: 1000 ms');
        $I->canSee('12-hour clock format');
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   AcceptanceTester $I
     * @throws \Exception
     */
    public function checkSubmitEmptyAnswer(AcceptanceTester $I) {
        $I->loginAsDemo();
        $I->amOnPage('/problem?problem_id=1');

        $I->click('#submit');
        $I->waitForElementVisible('#null', 3);
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   AcceptanceTester $I
     * @throws \Exception
     */
    public function checkSubmitJavaCode(AcceptanceTester $I) {
        $I->loginAsDemo();
        $I->amOnPage('/problem?problem_id=1');

        $I->clickWithLeftButton('.ui.dropdown.selection');
        $I->wait(1);
        $I->pressKey('.ui.dropdown.selection', 'J');
        $I->wait(1);
        $I->pressKey('.ui.dropdown.selection', ['enter']);
        $I->wait(1);
        $I->click('#submit');
        $I->wait(3);

        $I->canSee('Enter your code here. Read input from STDIN. Print output to STDOUT');
        $I->canSee('In Queue');
        $I->canSee('N/A');
        $I->canSee('Java');
    }


    public function checkProblemSubmissionsStep0(AcceptanceTester $I) {
        $I->loginAsDemo();
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
    public function checkSubmitCCode(AcceptanceTester $I) {
        $I->loginAsLiupangzi();
        $I->amOnPage('/problem?problem_id=1');

        $I->clickWithLeftButton('.ui.dropdown.selection');
        $I->wait(1);
        $I->pressKey('.ui.dropdown.selection', WebDriverKeys::ARROW_DOWN);
        $I->wait(1);
        $I->pressKey('.ui.dropdown.selection', WebDriverKeys::ENTER);
        $I->wait(1);
        $I->click('#submit');
        $I->wait(3);

        $I->canSee('stdio.h');
        $I->canSee('In Queue');
        $I->canSee('N/A');
        $I->canSee('C');
    }


    public function checkProblemSubmissionsStep1(AcceptanceTester $I) {
        $I->loginAsDemo();
        $I->amOnPage('/problem/submissions?problem_id=1');

        $I->canSee('liupangzi', 'body > div.ui.main.container > table > tbody > tr:nth-child(1)');
        $I->canSee('C', 'body > div.ui.main.container > table > tbody > tr:nth-child(1)');
        $I->canSee('In Queue', 'body > div.ui.main.container > table > tbody > tr:nth-child(1)');
        $I->canSee('N/A', 'body > div.ui.main.container > table > tbody > tr:nth-child(1)');
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   AcceptanceTester $I
     * @throws \Exception
     */
    public function checkSubmitCppCode(AcceptanceTester $I) {
        $I->loginAsLiupangzi();
        $I->amOnPage('/problem?problem_id=1');

        $I->clickWithLeftButton('.ui.dropdown.selection');
        $I->wait(1);
        $I->pressKey('.ui.dropdown.selection', WebDriverKeys::ARROW_DOWN);
        $I->wait(1);
        $I->pressKey('.ui.dropdown.selection', WebDriverKeys::ARROW_DOWN);
        $I->wait(1);
        $I->pressKey('.ui.dropdown.selection', WebDriverKeys::ENTER);
        $I->wait(1);
        $I->click('#submit');
        $I->wait(3);

        $I->canSee('iostream');
        $I->canSee('In Queue');
        $I->canSee('N/A');
        $I->canSee('C++');
    }


    public function checkProblemSubmissionsStep2(AcceptanceTester $I) {
        $I->loginAsDemo();
        $I->amOnPage('/problem/submissions?problem_id=1');

        $I->canSee('liupangzi', 'body > div.ui.main.container > table > tbody > tr:nth-child(1)');
        $I->canSee('C++', 'body > div.ui.main.container > table > tbody > tr:nth-child(1)');
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
        $I->loginAsDemo();
        $I->amOnPage('/problem/discussions?problem_id=1');

        $I->clickWithLeftButton('#add_reply');
        $I->waitForElementVisible('#null', 3);
        $I->wait(3);

        $faker = Factory::create();

        $demo_input = $faker->sentence;
        $I->pressKey('#reply > div.ql-editor.ql-blank', $demo_input);
        $I->clickWithLeftButton('#add_reply');
        $I->wait(3);
        $I->canSee($demo_input, 'body');

        $I->loginAsLiupangzi();
        $I->amOnPage('/problem/discussions?problem_id=1');

        $lpz_input = $faker->sentence;
        $I->pressKey('#reply > div.ql-editor.ql-blank', $lpz_input);
        $I->clickWithLeftButton('#add_reply');
        $I->wait(3);
        $I->canSee($lpz_input, 'body');
    }


    public function checkProblemEditorial(AcceptanceTester $I) {
        $I->loginAsDemo();
        $I->amOnPage('/problem/editorial?problem_id=1');
        $I->canSee('To be done.');
    }
}