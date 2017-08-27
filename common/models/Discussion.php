<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class Discussion
 * @package common\models
 * @property int $id [int(11)]
 * @property int $problem_id [int(11)]
 * @property int $user_id [int(11)]
 * @property string $content
 * @property int $up_vote [int(11)]
 * @property string $created_at [datetime]
 * @property string $updated_at [datetime]
 */
class Discussion extends ActiveRecord {
    const NOT_UP_VOTED = 0;
    const ALREADY_UP_VOTED = 1;


    public static function tableName() {
        return 't_discussion';
    }


    public function getProblem() {
        return $this->hasOne(Problem::className(), ['id' => 'problem_id'])->one();
    }


    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->one();
    }
}