<?php

namespace common\models;

use yii\db\ActiveRecord;


/**
 * Class ProblemTag
 * @package common\models
 * @property int $id [int(11)]
 * @property int $problem_id [int(11)]
 * @property int $tag_id [int(11)]
 * @property string $created_at [datetime]
 * @property string $updated_at [datetime]
 */
class ProblemTag extends ActiveRecord {
    public static function tableName() {
        return 't_problem_tag';
    }
}