<?php

namespace www\controllers;

use www\filters\UserLoggedinFilter;

class IndexController extends BaseController {
    public function behaviors() {
        return [
            ['class' => UserLoggedinFilter::className()],
        ];
    }


    public function actionIndex() {
        return $this->render('index');
    }
}
