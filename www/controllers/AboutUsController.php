<?php

namespace www\controllers;

class AboutUsController extends BaseController {
    public function actionIndex() {
        $this->view->title = 'Justice PLUS - About US';
        return $this->render('index');
    }
}
