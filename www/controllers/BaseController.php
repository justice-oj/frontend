<?php

namespace www\controllers;

use Yii;
use yii\web\Controller;

class BaseController extends Controller {
    public function init() {
        parent::init();

        Yii::$app->session->open();
        Yii::$app->session->setTimeout(86400 * 30);
    }
}
