<?php

namespace www\controllers;

class AboutController extends BaseController {
    public function actionIndex() {
        $this->view->title = 'Justice PLUS - About';
        return $this->render('index');
    }
}
