<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class Admin
 * @package common\models
 * @property int $id [int(11)]
 * @property string $username [varchar(255)]
 * @property string $password [varchar(255)]
 * @property string $created_at [datetime]
 * @property string $updated_at [datetime]
 */
class Admin extends ActiveRecord {
    public static function tableName() {
        return 't_admin';
    }
}