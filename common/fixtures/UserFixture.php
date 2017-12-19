<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture {
    public $modelClass = 'common\models\User';

    protected function getData() {
        /** @noinspection SpellCheckingInspection */
        return [
            [
                'username' => 'liupangzi',
                'password' => '$2a$12$nuhvReHg6Z26hhY2vrM/O.3YIx4ylLAhHjHhC9fboxlKs6Ek4afzq',
                'nickname' => 'Chao Liu',
                'bio' => 'No one told you when to run, you missed the starting gun.',
                'email' => 'thesedays@126.com',
                'website' => 'https://www.liuchao.me',
                'country' => 'jp',
                'created_at' => '1988-08-29 12:00:00',
                'updated_at' => '2017-08-02 23:46:03',
            ],
            [
                'username' => 'demo',
                'password' => '$2a$12$Lgi8HoRwGbxzVA5JpZ.PTe3ouDMR/KjYihX.KJyP3/ryPlJIkImce',
                'nickname' => 'demo',
                'bio' => 'I am a robot.',
                'email' => 'i@liuchao.me',
                'website' => 'https://www.liuchao.me',
                'country' => 'us',
            ],
        ];
    }
}