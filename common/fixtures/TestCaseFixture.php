<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class TestCaseFixture extends ActiveFixture {
    public $modelClass = 'common\models\TestCase';

    public $depends = [
        'common\fixtures\ProblemFixture',
    ];

    protected function getData() {
        return [
            [
                'problem_id' => 2,
                'input' => '07:05:45PM',
                'output' => '19:05:45',
            ],
            [
                'problem_id' => 2,
                'input' => '12:00:00AM',
                'output' => '00:00:00',
            ],
            [
                'problem_id' => 2,
                'input' => '12:00:00PM',
                'output' => '12:00:00',
            ],
            [
                'problem_id' => 2,
                'input' => '12:01:00PM',
                'output' => '12:01:00',
            ],
            [
                'problem_id' => 2,
                'input' => '11:59:59PM',
                'output' => '23:59:59',
            ],
            [
                'problem_id' => 2,
                'input' => '07:05:45AM',
                'output' => '07:05:45',
            ],
        ];
    }
}