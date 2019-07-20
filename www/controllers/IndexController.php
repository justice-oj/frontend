<?php

namespace www\controllers;

use www\filters\UserLoggedInFilter;

class IndexController extends BaseController {
    public function behaviors() {
        return [
            ['class' => UserLoggedInFilter::class, 'except' => ['index']],
        ];
    }


    public function actionIndex() {
        $this->view->title = 'Justice PLUS - Main Page';
        return $this->render('index');
    }
}
