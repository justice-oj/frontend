<?php

namespace admin\modules\problem\controllers;

use yii\web\Controller;

class NewController extends Controller {
    public function actionIndex() {
        return $this->render('index');
    }
}