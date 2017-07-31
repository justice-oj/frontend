<?php

namespace common\models;

use yii\db\ActiveRecord;


/**
 * Class Submission
 * @package common\models
 * @property int $id [int(10) unsigned]
 * @property int $user_id [int(10) unsigned]  id of `t_user`
 * @property int $problem_id [int(10) unsigned]  id of `t_problem`
 * @property int $language [int(11)]  language of solution
 * @property string $code content of solution
 * @property int $status [int(11)]  judging status
 * @property int $runtime [int(11)]  runtime cost of this solution
 * @property int $memory [int(11)]  memory cost of this solution
 * @property string $created_at [datetime]
 * @property string $updated_at [datetime]
 */
class Submission extends ActiveRecord {
    const LANGUAGE_C = 0;
    const LANGUAGE_CPP = 1;
    const LANGUAGE_PYTHON2 = 2;
    const LANGUAGE_PYTHON3 = 3;
    const LANGUAGE_JAVA = 4;


    const STATUS_QUEUE = -1;
    const STATUS_AC = 0;
    const STATUS_CE = 1;
    const STATUS_RE = 2;
    const STATUS_TLE = 3;
    const STATUS_MLE = 4;
    const STATUS_WA = 5;


    public static function tableName() {
        return 't_submission';
    }


    public function getProblem() {
        return $this->hasOne(Problem::className(), ['id' => 'problem_id']);
    }


    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}