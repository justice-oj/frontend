<?php

namespace common\models;

use yii\db\ActiveRecord;

class Editorial extends ActiveRecord {
    public static function tableName() {
        return 't_editorial';
    }
}