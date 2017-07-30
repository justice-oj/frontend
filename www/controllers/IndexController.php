<?php

namespace www\controllers;

use www\filters\UserLoggedinFilter;

class IndexController extends BaseController {
    public function behaviors() {
        return [
            ['class' => UserLoggedinFilter::className(), 'except' => ['index']],
        ];
    }


    public function actionIndex() {
        $this->view->title = 'Justice PLUS - Main Page';
        return $this->render('index');
    }
}
