<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class User
 * @package common\models
 * @property int $id [int(10) unsigned]
 * @property string $username [varchar(64)]  unique username
 * @property string $password [varchar(255)]  bcrypt-ed password
 * @property string $nickname [varchar(64)]  nickname
 * @property string $bio bio
 * @property string $email [varchar(128)]  email address
 * @property string $website [varchar(512)]  personal website
 * @property string $country [varchar(64)]  location(also associated with flag icon)
 * @property int $submission_count [int(11)]  total submissions count of this user
 * @property int $accepted_count [int(11)]  unique solved problems count of this user
 * @property string $created_at [datetime]
 * @property string $updated_at [datetime]
 */
class User extends ActiveRecord {
    public static function tableName() {
        return 't_user';
    }
}