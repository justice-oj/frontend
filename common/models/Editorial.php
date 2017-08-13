<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class Editorial
 * @package common\models
 * @property int $id [int(11)]
 * @property int $problem_id [int(11)]
 * @property int $author_id [int(11)]
 * @property string $content
 * @property string $created_at [datetime]
 * @property string $updated_at [datetime]
 */
class Editorial extends ActiveRecord {
    public static function tableName() {
        return 't_editorial';
    }
}