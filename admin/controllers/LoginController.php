<?php

namespace admin\controllers;

use yii\web\Controller;

class LoginController extends Controller {
    public function actionIndex() {
        $this->layout = 'login';
        return $this->render('index');
    }
}
