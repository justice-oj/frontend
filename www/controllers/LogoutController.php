<?php

namespace www\controllers;

use Yii;

class LogoutController extends BaseController {
    public function actionIndex() {
        Yii::$app->session->remove(Yii::$app->params['userLoggedInKey']);
        Yii::$app->session->remove(Yii::$app->params['userIdKey']);
        return $this->redirect('/');
    }
}
