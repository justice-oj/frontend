<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class ProblemTagFixture extends ActiveFixture {
    public $modelClass = 'common\models\ProblemTag';

    public $depends = [
        'common\fixtures\ProblemFixture',
        'common\fixtures\TagFixture',
    ];

    protected function getData() {
        return [
            [
                'problem_id' => 1,
                'tag_id' => 2,
            ]
        ];
    }
}