<?php

namespace admin\controllers;

use admin\filters\AdminLoggedinFilter;

class IndexController extends BaseController {
    public function behaviors() {
        return [
            ['class' => AdminLoggedinFilter::className()],
        ];
    }


    public function actionIndex() {
        return $this->render('index');
    }
}