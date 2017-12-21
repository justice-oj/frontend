<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class DiscussionFixture extends ActiveFixture {
    public $modelClass = 'common\models\Discussion';

    public $depends = [
        'common\fixtures\ProblemFixture',
        'common\fixtures\UserFixture',
    ];

    protected function getData() {
        return [];
    }
}