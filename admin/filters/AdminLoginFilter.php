<?php

namespace admin\filters;

use Yii;
use yii\base\ActionFilter;

class AdminLoginFilter extends ActionFilter {
    public function beforeAction($action) {
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');

        if (empty($username) || empty($password)) {
            echo json_encode([
                'message' => 'email or password empty',
                'code' => 255
            ]);
            return false;
        }
        return parent::beforeAction($action);
    }
}