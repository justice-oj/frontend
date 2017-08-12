<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class EditorialFixture extends ActiveFixture {
    public $modelClass = 'common\models\Editorial';

    public $depends = [
        'common\fixtures\ProblemFixture',
        'common\fixtures\UserFixture',
    ];
}