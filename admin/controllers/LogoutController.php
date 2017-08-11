<?php

namespace admin\controllers;

use Yii;

class LogoutController extends BaseController {
    public function actionIndex() {
        Yii::$app->session->removeAll();
        return $this->redirect('/');
    }
}