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
                'problem_id' => 1,
                'input' => '07:05:45PM',
                'output' => '19:05:45',
            ],
            [
                'problem_id' => 1,
                'input' => '04:45:45AM',
                'output' => '04:45:45',
            ],
            [
                'problem_id' => 1,
                'input' => '12:00:00AM',
                'output' => '00:00:00',
            ],
            [
                'problem_id' => 1,
                'input' => '12:00:00PM',
                'output' => '12:00:00',
            ],
            [
                'problem_id' => 1,
                'input' => '01:01:00PM',
                'output' => '13:01:00',
            ],
            [
                'problem_id' => 1,
                'input' => '01:01:12AM',
                'output' => '01:01:12',
            ],
            [
                'problem_id' => 1,
                'input' => '11:59:59PM',
                'output' => '23:59:59',
            ],
            [
                'problem_id' => 1,
                'input' => '11:59:59AM',
                'output' => '11:59:59',
            ],
        ];
    }
}