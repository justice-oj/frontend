<?php

namespace common\models;

use yii\db\ActiveRecord;


/**
 * Class UserProblem
 * @package common\models
 * @property int $id [int(10) unsigned]
 * @property int $user_id [int(10) unsigned]  id of `t_user`
 * @property int $problem_id [int(10) unsigned]  id of `t_problem`
 * @property int $status [int(11)]  null == IN QUEUE / 2 == tried but failed / 1 == solved
 * @property string $created_at [datetime]
 * @property string $updated_at [datetime]
 */
class UserProblem extends ActiveRecord {
    const STATUS_SOLVED = 1;
    const STATUS_TRIED = 2;


    public static function tableName() {
        return 't_user_problem';
    }


    public function getProblem() {
        return $this->hasOne(Problem::className(), ['id' => 'problem_id']);
    }


    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}