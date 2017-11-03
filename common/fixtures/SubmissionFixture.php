<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class SubmissionFixture extends ActiveFixture {
    public $modelClass = 'common\models\Submission';

    public $depends = [
        'common\fixtures\ProblemFixture',
        'common\fixtures\UserFixture',
    ];

    protected function getData() {
        return [];
    }
}