<?php

namespace www\tests\acceptance;

use Faker\Factory;
use www\tests\AcceptanceTester;

class NoticeCest {
    private $_faker;

    /**
     * NoticeCest constructor.
     */
    public function __construct() {
        $this->_faker = Factory::create();
    }


    public function checkDemoLeftTwoMessages(AcceptanceTester $I) {
        $I->loginAsDemo();
        $I->amOnPage('/problem/discussions?problem_id=1');

        $m0 = $this->_faker->paragraph;
        $I->pressKey('#reply > div.ql-editor', $m0);
        $I->wait(1);
        $I->clickWithLeftButton('#add_reply');
        $I->wait(2);
        $I->canSee($m0, 'body');

        $m1 = $this->_faker->paragraph;
        $I->clickWithLeftButton('.reply.quick_reply');
        $I->wait(1);
        $I->pressKey('#reply > div.ql-editor', $m1);
        $I->wait(1);
        $I->clickWithLeftButton('#add_reply');
        $I->wait(2);
        $I->canSee($m1, 'body');
        $I->canSeeLink('@demo', '/profile?name=demo');
        $I->moveMouseOver('.ui.right.floated.simple.dropdown.item');
        $I->cantSee('1', '.ui.red.circular.label');
    }


    public function checkLiupangziReplied(AcceptanceTester $I) {
        $I->loginAsLiupangzi();
        $I->amOnPage('/problem/discussions?problem_id=1');

        $m2 = $this->_faker->paragraph;
        $I->clickWithLeftButton('body > div.ui.main.container > div.ui.large.comments > div:nth-child(2) > div > div.actions > a');
        $I->wait(1);
        $I->pressKey('#reply > div.ql-editor', $m2);
        $I->wait(1);
        $I->clickWithLeftButton('#add_reply');
        $I->wait(2);
        $I->canSee($m2, 'body');

        $m3 = $this->_faker->paragraph;
        $I->clickWithLeftButton('body > div.ui.main.container > div.ui.large.comments > div:nth-child(5) > div > div.actions > a');
        $I->wait(1);
        $I->pressKey('#reply > div.ql-editor', $m3);
        $I->wait(1);
        $I->clickWithLeftButton('#add_reply');
        $I->wait(2);
        $I->canSee($m3, 'body');
    }


    public function checkDemoGotMentions(AcceptanceTester $I) {
        $I->loginAsDemo();

        $I->amOnPage('/problem/discussions?problem_id=1');
        $I->moveMouseOver('.ui.right.floated.simple.dropdown.item');
        $I->canSee('2', '.ui.red.circular.label');

        $I->amOnPage('/notifications');
        $I->moveMouseOver('.ui.right.floated.simple.dropdown.item');
        $I->cantSee('2', '.ui.red.circular.label');
        $I->cantSeeLink('demo', '/profile?name=demo');
        $I->canSeeLink('liupangzi', '/profile?name=liupangzi');
        $I->canSeeLink('Time Conversion', '/problem/discussions?problem_id=1#L4');
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param AcceptanceTester $I
     * @throws \Exception
     * @desc
     */
    public function checkDemoUpVotedLiupangzi(AcceptanceTester $I) {
        $I->loginAsDemo();

        $I->amOnPage('/problem/discussions?problem_id=1');
        $I->clickWithLeftButton('body > div.ui.main.container > div.ui.large.comments > div:nth-child(2) > div > div.metadata > div.rating > i');
        $I->wait(1);
        $I->clickWithLeftButton('body > div.ui.main.container > div.ui.large.comments > div:nth-child(5) > div > div.metadata > div.rating > i');
        $I->wait(1);
        $I->clickWithLeftButton('body > div.ui.main.container > div.ui.large.comments > div:nth-child(8) > div > div.metadata > div.rating > i');
        $I->waitForElementVisible('#tip_header', 3);
        $I->canSee('vote failed', '#tip_desc');
    }


    public function checkLiupangziGotUpVotedNotices(AcceptanceTester $I) {
        $I->loginAsLiupangzi();
        $I->amOnPage('/problem/discussions?problem_id=1');

        $I->moveMouseOver('.ui.right.floated.simple.dropdown.item');
        $I->canSee('2', '.ui.red.circular.label');

        $I->amOnPage('/notifications');
        $I->moveMouseOver('.ui.right.floated.simple.dropdown.item');
        $I->cantSee('2', '.ui.red.circular.label');

        $I->cantSeeLink('liupangzi', '/profile?name=liupangzi');
        $I->canSeeLink('demo', '/profile?name=demo');
        $I->canSeeLink('Time Conversion', '/problem/discussions?problem_id=1#L4');
    }
}