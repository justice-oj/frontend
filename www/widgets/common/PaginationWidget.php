<?php

namespace www\widgets\common;

use Yii;
use yii\base\Widget;

class PaginationWidget extends Widget {
    public $pagination;

    public function run() {
        return $this->render('pagination', [
            'pagination' => $this->pagination,
            'uri' => '/' . Yii::$app->request->getPathInfo() . '?',
            'query' => Yii::$app->request->getQueryParams(),
        ]);
    }
}