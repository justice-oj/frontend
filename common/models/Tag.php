<?php

namespace common\models;

use yii\db\ActiveRecord;


/**
 * Class Tag
 * @package common\models
 * @property int $id [int(11)]
 * @property string $name [varchar(255)]
 * @property string $created_at [datetime]
 * @property string $updated_at [datetime]
 */
class Tag extends ActiveRecord {
    public static function tableName() {
        return 't_tag';
    }
}