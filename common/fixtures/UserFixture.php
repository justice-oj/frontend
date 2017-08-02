<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture {
    public $modelClass = 'common\models\User';

    protected function getData() {
        return [
            [
                'username' => 'liupangzi',
                'password' => '$2a$12$nuhvReHg6Z26hhY2vrM/O.3YIx4ylLAhHjHhC9fboxlKs6Ek4afzq',
                'nickname' => 'Chao Liu',
                'bio' => 'No one told you when to run, you missed the starting gun.',
                'email' => 'thesedays@126.com',
                'website' => 'https://www.liuchao.me',
                'country' => 'jp',
                'submission_count' => 1024,
                'accepted_count' => 512,
                'created_at' => '2000-01-01 00:00:00',
                'updated_at' => '2017-08-02 23:46:03',
            ],
        ];
    }
}