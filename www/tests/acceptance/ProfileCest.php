<?php

namespace www\tests\acceptance;

use Facebook\WebDriver\WebDriverKeys;
use Faker\Factory;
use www\tests\AcceptanceTester;

class ProfileCest {
    public function checkCheckDefaultProfile(AcceptanceTester $I) {
        $I->loginAsDemo();
        $I->amOnPage('/profile?name=demo');

        $I->canSee('demo');
        $I->canSee('https://www.liuchao.me');
        $I->canSee('I am a robot.');
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

        $I->loginAsDemo();
        $I->amOnPage('/settings');

        // original state
        $I->seeInField('//*[@id="nickname"]', 'demo');
        $I->seeInField('//*[@id="website"]', 'https://www.liuchao.me');
        $I->canSee('United States');
        $I->cantSee('Vanuatu');
        $I->seeInField('//*[@id="bio"]', 'I am a robot.');

        $I->fillField('#nickname', $nickname);
        $I->fillField('#website', $website);
        $I->clickWithLeftButton('.ui.search.dropdown.selection');
        $I->pressKey('input.search', 'Vanuatu');
        $I->wait(1);
        $I->pressKey('input.search', WebDriverKeys::ENTER);
        $I->wait(1);
        $I->fillField('#bio', $bio);
        $I->clickWithLeftButton('#update');
        $I->wait(1);
        $I->seeInPopup('OK');
        $I->acceptPopup();
        $I->wait(1);

        $I->seeInField('//*[@id="nickname"]', $nickname);
        $I->seeInField('//*[@id="website"]', $website);
        $I->canSee('Vanuatu');
        $I->cantSee('United States');
        $I->seeInField('//*[@id="bio"]', $bio);

        $I->fillField('#nickname', 'demo');
        $I->fillField('#website', 'https://www.liuchao.me');
        $I->clickWithLeftButton('.ui.search.dropdown.selection');
        $I->pressKey('input.search', 'United States');
        $I->wait(1);
        $I->pressKey('input.search', WebDriverKeys::ENTER);
        $I->wait(1);
        $I->fillField('#bio', 'I am a robot.');
        $I->clickWithLeftButton('#update');
        $I->wait(1);
        $I->seeInPopup('OK');
        $I->acceptPopup();
        $I->wait(1);

        // original state
        $I->seeInField('//*[@id="nickname"]', 'demo');
        $I->seeInField('//*[@id="website"]', 'https://www.liuchao.me');
        $I->canSee('United States');
        $I->cantSee('Vanuatu');
        $I->seeInField('//*[@id="bio"]', 'I am a robot.');
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
        $I->loginAsDemo();
        $I->amOnPage('/settings/password');

        $I->fillField('#a', 'demo');
        $I->fillField('#b', 'wakaka');
        $I->fillField('#c', 'wakaka');
        $I->clickWithLeftButton('#update');
        $I->wait(1);
        $I->canSeeInPopup('OK');
        $I->acceptPopup();

        $I->amOnPage('/logout');
        $I->wait(1);
        $I->canSeeLink('Login', '/login');

        $I->amOnPage('/login');
        $I->fillField('#email', 'i@liuchao.me');
        $I->fillField('#password', 'wakaka');

        $I->click('//*[@id="auth"]');
        $I->wait(2);
        $I->canSee('demo');

        $I->amOnPage('/settings/password');
        $I->fillField('#a', 'wakaka');
        $I->fillField('#b', 'demo');
        $I->fillField('#c', 'demo');
        $I->clickWithLeftButton('#update');
        $I->wait(2);
        $I->canSeeInPopup('OK');
        $I->acceptPopup();
    }
}