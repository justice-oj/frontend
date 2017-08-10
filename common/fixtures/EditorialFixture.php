<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class EditorialFixture extends ActiveFixture {
    public $modelClass = 'common\models\Editorial';

    public $depends = [
        'common\fixtures\ProblemFixture',
        'common\fixtures\UserFixture',
    ];

    protected function getData() {
        return [
            [
                'problem_id' => 1,
                'author_id' => 1,
                'content' => '<h2>Articles</h2><a href="https://en.wikipedia.org/wiki/Longest_common_subsequence_problem" target="_blank">Wikipedia</a><h2>Video from Geeksforgeeks:</h2><div class="ui embed" data-source="youtube" data-id="HgUOWB0StNE"></div>',
            ],
        ];
    }
}