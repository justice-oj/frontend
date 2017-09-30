<?php

namespace www\controllers;

use common\models\Submission;
use common\services\SubmissionService;
use common\services\UserService;
use Kilte\Pagination\Pagination;
use www\filters\UserLoggedinFilter;
use Yii;

class SubmissionsController extends BaseController {
    protected $submissionService;
    protected $userService;


    public function __construct(
        $id,
        $module,
        SubmissionService $submissionService,
        UserService $userService,
        $config = []
    ) {
        $this->submissionService = $submissionService;
        $this->userService = $userService;
        parent::__construct($id, $module, $config);
    }


    public function behaviors() {
        return [
            ['class' => UserLoggedinFilter::className()],
        ];
    }


    public function actionIndex() {
        $page = intval(Yii::$app->request->get('page', 1));
        $limit = intval(Yii::$app->params['paginationPerPage']);
        $this->view->title = 'Justice PLUS - Submissions';

        return $this->render('index', [
            'pagination' => (new Pagination(Submission::find()->select('id')->count(), $page, $limit))->build(),
            'records' => $this->submissionService->getSubmissionsList($page),
        ]);
    }
}
