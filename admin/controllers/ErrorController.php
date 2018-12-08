<?php

namespace admin\controllers;

class ErrorController extends BaseController
{
    public function __construct(
        $id,
        $module,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        return $this->renderPartial('index');
    }
}