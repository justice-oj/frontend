<?php

namespace admin\modules\user\controllers;

use yii\web\Controller;

class IndexController extends Controller {
    public function actionIndex() {
        $a = [];
        $a['test'] = 'cintent';
        return $this->render('index');
    }
}