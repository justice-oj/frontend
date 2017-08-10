<?php

namespace common\fixtures;

use common\models\Submission;
use Faker\Factory;
use Faker\Provider\DateTime;
use yii\test\ActiveFixture;

class SubmissionFixture extends ActiveFixture {
    public $modelClass = 'common\models\Submission';

    public $depends = [
        'common\fixtures\ProblemFixture',
        'common\fixtures\UserFixture',
    ];

    protected function getData() {
        $faker = Factory::create();
        $datetime_faker = new DateTime($faker);

        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'user_id' => $faker->randomElement([1, 2]),
                'problem_id' => $faker->randomElement([1, 2]),
                'language' => $faker->randomElement([
                    Submission::LANGUAGE_C,
                    Submission::LANGUAGE_CPP,
                    Submission::LANGUAGE_PYTHON2,
                    Submission::LANGUAGE_PYTHON3,
                    Submission::LANGUAGE_JAVA,
                ]),
                'code' => $faker->text,
                'status' => $faker->randomElement([
                    Submission::STATUS_QUEUE,
                    Submission::STATUS_AC,
                    Submission::STATUS_CE,
                    Submission::STATUS_RE,
                    Submission::STATUS_TLE,
                    Submission::STATUS_MLE,
                    Submission::STATUS_WA
                ]),
                'runtime' => $faker->numberBetween(-1, 1000),
                'memory' => $faker->numberBetween(-1, 1000),
            ];
        }
        return $data;
    }
}