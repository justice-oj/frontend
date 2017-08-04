<?php

namespace www\controllers;

use common\services\SubmissionService;
use www\filters\UserLoggedinFilter;
use Yii;

class SubmissionController extends BaseController {
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


    public function actionIndex(int $id) {
        $submission = $this->submissionService->getSubmissionByID($id);

        if (is_null($submission)) {
            Yii::$app->response->redirect([
                'error/index',
                'message' => 'This submission does not exist.'
            ]);
            return false;
        }

        return $this->render('index', [
            'submission' => $submission,
            'user' => $submission->getUser(),
            'problem' => $submission->getProblem()
        ]);
    }
}
