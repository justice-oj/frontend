<?php

namespace common\fixtures;

use common\models\UserProblem;
use yii\test\ActiveFixture;

class UserProblemFixture extends ActiveFixture {
    public $modelClass = 'common\models\UserProblem';

    protected function getData() {
        return [
            [
                'user_id' => 2,
                'problem_id' => 1,
                'status' => UserProblem::STATUS_SOLVED,
                'created_at' => '1988-08-29 12:00:00',
                'updated_at' => '2017-08-02 23:46:03',
            ],
            [
                'user_id' => 1,
                'problem_id' => 1,
                'status' => UserProblem::STATUS_TRIED,
                'created_at' => '1988-08-29 12:00:00',
                'updated_at' => '2017-08-02 23:46:03',
            ],
            [
                'user_id' => 2,
                'problem_id' => 2,
                'status' => UserProblem::STATUS_SOLVED,
                'created_at' => '1988-08-29 12:00:00',
                'updated_at' => '2017-08-02 23:46:03',
            ],
            [
                'user_id' => 1,
                'problem_id' => 2,
                'status' => UserProblem::STATUS_SOLVED,
                'created_at' => '1988-08-29 12:00:00',
                'updated_at' => '2017-08-02 23:46:03',
            ],
        ];
    }
}