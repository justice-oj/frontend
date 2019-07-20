<?php

namespace common\models;

use yii\db\ActiveRecord;


/**
 * Class Problem
 * @package common\models
 * @property int $id [int(10) unsigned]
 * @property string $title [varchar(255)]  title of problem
 * @property string $description description of problem
 * @property int $level [int(11)]  AKA difficulty, from 1(easy) to 10(difficult)
 * @property int $runtime_limit [int(11)]  runtime limitation(ms)
 * @property int $memory_limit [int(11)]  memory limitation(MB)
 * @property string $created_at [datetime]
 * @property string $updated_at [datetime]
 */
class Problem extends ActiveRecord {
    const STATUS_UNSOLVED = 0;
    const STATUS_TRIED = 1;
    const STATUS_SOLVED = 2;


    public static function tableName() {
        return 't_problem';
    }


    public function getSubmissionCount() {
        return $this
            ->hasMany(Submission::class, ['problem_id' => 'id'])
            ->count();
    }


    public function getAcceptedCount() {
        return $this
            ->hasMany(Submission::class, ['problem_id' => 'id'])
            ->andOnCondition(['status' => Submission::STATUS_AC])
            ->count();
    }
}