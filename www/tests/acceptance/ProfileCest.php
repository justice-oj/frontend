<?php

namespace www\tests\acceptance;

use Faker\Factory;
use www\tests\AcceptanceTester;

class ProfileCest {
    public function checkCheckDefaultProfile(AcceptanceTester $I) {
        $I->userDemoLogin();
        $I->amOnPage('/profile?name=demo');
        $I->canSee('demo', '#nickname');
        $I->canSee('https://www.liuchao.me', '#website');
        $I->canSee('I am a robot.', '#bio');
        $I->canSee('i@liuchao.me');
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param AcceptanceTester $I
     * @return void
     * @throws \Codeception\Exception\ModuleException
     * @desc
     */
    public function checkUpdateProfile(AcceptanceTester $I) {
        $faker = Factory::create();
        $nickname = $faker->userName;
        $website = $faker->url;
        $bio = $faker->sentence;

        $I->userDemoLogin();
        $I->amOnPage('/settings');

        $I->fillField('#nickname', $nickname);
        $I->fillField('#website', $website);
        $I->fillField('#bio', $bio);
        $I->clickWithLeftButton('#update');
        $I->canSeeInPopup('OK');
        $I->wait(3);

        $I->canSee($nickname, '#nickname');
        $I->canSee($website, '#website');
        $I->canSee($bio, '#bio');
        $I->canSee('i@liuchao.me');

        $I->fillField('#nickname', 'demo');
        $I->fillField('#website', 'https://www.liuchao.me');
        $I->fillField('#bio', 'I am a robot.');
        $I->clickWithLeftButton('#update');
        $I->canSeeInPopup('OK');
        $I->pressKey('body', ['enter']);
        $I->wait(3);

        $I->canSee('demo', '#nickname');
        $I->canSee('https://www.liuchao.me', '#website');
        $I->canSee('I am a robot.', '#bio');
        $I->canSee('i@liuchao.me');
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param AcceptanceTester $I
     * @return void
     * @throws \Codeception\Exception\ModuleException
     * @desc
     */
    public function checkUpdatePassword(AcceptanceTester $I) {
        $I->userDemoLogin();
        $I->amOnPage('/settings/password');

        $faker = Factory::create();
        $password = $faker->password;

        $I->fillField('#a', 'demo');
        $I->fillField('#b', $password);
        $I->fillField('#c', $password);
        $I->clickWithLeftButton('#update');
        $I->canSeeInPopup('OK');
        $I->pressKey('body', ['enter']);

        $I->amOnPage('/logout');
        $I->canSeeLink('Login', '/login');

        $I->amOnPage('/login');
        $I->fillField('#email', 'i@liuchao.me');
        $I->fillField('#password', $password);

        $I->click('//*[@id="auth"]');
        $I->wait(3);
        $I->canSee('demo');

        $I->amOnPage('/settings/password');
        $I->fillField('#a', $password);
        $I->fillField('#b', 'demo');
        $I->fillField('#c', 'demo');
        $I->clickWithLeftButton('#update');
        $I->canSeeInPopup('OK');
        $I->pressKey('body', ['enter']);
    }
}