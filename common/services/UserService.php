<?php

namespace common\services;

use common\models\User;

class UserService extends User {
    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   string $email
     * @desc
     * @return  \common\models\User|null
     */
    public function getUserByEmail(string $email) {
        return $this->find()->where(['email' => $email])->one();
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   string $password
     * @return  bool
     * @desc    validate user's password
     */
    public function validateUserPassword(string $password) {
        return password_verify($password, $this->password);
    }
}