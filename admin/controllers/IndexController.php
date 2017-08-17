<?php

namespace admin\controllers;

use admin\filters\AdminLoggedinFilter;
use common\services\ProblemService;
use common\services\SubmissionService;
use common\services\UserService;

class IndexController extends BaseController {
    protected $userService;
    protected $problemService;
    protected $submissionService;


    public function __construct(
        $id,
        $module,
        ProblemService $problemService,
        UserService $userService,
        SubmissionService $submissionService,
        $config = []
    ) {
        $this->problemService = $problemService;
        $this->userService = $userService;
        $this->submissionService = $submissionService;
        parent::__construct($id, $module, $config);
    }


    public function behaviors() {
        return [
            ['class' => AdminLoggedinFilter::className()],
        ];
    }


    public function actionIndex() {
        $this->view->title = 'Justice PLUS Admin';
        return $this->render('index', [
            'problems_count' => $this->problemService->getTotalProblemsCount(),
            'users_count' => $this->userService->getTotalUsersCount(),
            'submissions_count' => $this->submissionService->getTotalSubmissionsCount()
        ]);
    }
}