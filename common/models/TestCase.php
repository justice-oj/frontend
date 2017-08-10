<?php

namespace common\models;

use yii\db\ActiveRecord;

class TestCase extends ActiveRecord {
    public static function tableName() {
        return 't_test_case';
    }
}