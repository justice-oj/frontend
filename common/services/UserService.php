<?php

namespace common\services;

use common\models\User;

/**
 * Class UserService
 * @package common\services
 */
class UserService {
    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $id
     * @return \common\models\User|null
     * @desc
     */
    public function getUserByID(int $id) {
        return User::findOne($id);
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   string $email
     * @desc
     * @return  \common\models\User|null
     */
    public function getUserByEmail(string $email) {
        return User::find()->where(['email' => $email])->one();
    }
}