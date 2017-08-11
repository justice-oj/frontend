<?php

namespace admin\controllers;

class IndexController extends BaseController {
    public function actionIndex() {
        return $this->render('index');
    }
}