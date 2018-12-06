<?php

namespace admin\filters;

use Yii;
use yii\base\ActionFilter;
use yii\web\Response;

class AdminLoginFilter extends ActionFilter
{
    public function beforeAction($action)
    {
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');

        if (empty($username) || empty($password)) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            Yii::$app->response->content = json_encode([
                'message' => 'Email or password empty',
                'code' => 255
            ]);
            return false;
        }
        return parent::beforeAction($action);
    }
}