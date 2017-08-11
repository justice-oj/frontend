<?php

namespace common\services;

use common\models\Admin;

/**
 * Class UserService
 * @package common\services
 */
class AdminService {
    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param string $username
     * @return Admin|null
     * @desc
     */
    public function getAdminByUsername(string $username) {
        return Admin::find()->where(['username' => $username])->one();
    }
}