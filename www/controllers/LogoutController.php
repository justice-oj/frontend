<?php

namespace www\controllers;

use Yii;

class LogoutController extends BaseController {
    public function actionIndex() {
        Yii::$app->session->remove('logged_in');
        return $this->redirect('/login');
    }
}
