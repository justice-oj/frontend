<?php

namespace admin\widgets\common;

use Yii;
use yii\base\Widget;

class PaginationWidget extends Widget {
    public $pagination;

    public function run() {
        if (count($this->pagination) > 0) {
            return $this->render('pagination', [
                'pagination' => $this->pagination,
                'uri' => '/' . Yii::$app->request->getPathInfo() . '?',
                'query' => Yii::$app->request->getQueryParams(),
            ]);
        }
    }
}