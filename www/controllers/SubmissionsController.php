<?php

namespace www\controllers;

use common\services\SubmissionService;
use www\filters\UserLoggedinFilter;

class SubmissionsController extends BaseController {
    protected $submissionService;


    public function __construct(
        $id,
        $module,
        SubmissionService $submissionService,
        $config = []
    ) {
        $this->submissionService = $submissionService;
        parent::__construct($id, $module, $config);
    }


    public function behaviors() {
        return [
            ['class' => UserLoggedinFilter::className()],
        ];
    }


    public function actionProblem(int $id) {
        $this->view->title = 'Justice PLUS - Submission';

        $query = $this->submissionService->

        return $this->render('problem', [

        ]);
    }
}
