<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class AdminFixture extends ActiveFixture {
    public $modelClass = 'common\models\Admin';

    protected function getData() {
        /** @noinspection SpellCheckingInspection */
        return [
            [
                'username' => 'admin',
                'password' => '$2a$12$QNov/Vyp4KhTWAQavcEy0ue9AMXRvjqp.rwi1xb1Jfz6s9h8OZYP2',
            ],
        ];
    }
}