<?php

namespace www\filters;

use Yii;
use yii\base\ActionFilter;
use yii\web\Response;

class UserLoginFilter extends ActionFilter {
    public function beforeAction($action) {
        $email = Yii::$app->request->post('email');
        $password = Yii::$app->request->post('password');

        if (empty($email) || empty($password)) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            Yii::$app->response->content = json_encode([
                'message' => 'Email or password error.',
                'code' => 255
            ]);
            return false;
        }
        return parent::beforeAction($action);
    }
}