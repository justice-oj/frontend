<?php

namespace www\controllers;

use common\services\ProblemService;
use www\filters\UserLoggedinFilter;

class ProblemController extends BaseController {
    protected $problemService;


    public function __construct(
        $id,
        $module,
        ProblemService $problemService,
        $config = []
    ) {
        $this->problemService = $problemService;
        parent::__construct($id, $module, $config);
    }


    public function behaviors() {
        return [
            ['class' => UserLoggedinFilter::className()],
        ];
    }


    public function actionIndex(int $id) {
        $this->view->title = 'Justice PLUS - Problem';

        $problem = $this->problemService->getProblemByID($id);

        return $this->render('index', [
            'problem' => $problem,
        ]);
    }
}
