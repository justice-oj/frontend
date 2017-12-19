<?php

namespace admin\filters;

use Yii;
use yii\base\ActionFilter;

class AdminLoggedInFilter extends ActionFilter {
    public function beforeAction($action) {
        if (Yii::$app->session->get(Yii::$app->params['adminLoggedInKey']) != 1) {
            $action->controller->redirect('/login');
            return false;
        }
        return parent::beforeAction($action);
    }
}