<?php

namespace www\controllers;

use common\models\Problem;
use common\services\UserService;
use www\filters\UserLoggedInFilter;
use Yii;

class ProfileController extends BaseController {
    protected $userService;


    public function __construct(
        $id,
        $module,
        UserService $userService,
        $config = []
    ) {
        $this->userService = $userService;
        parent::__construct($id, $module, $config);
    }


    public function behaviors() {
        return [
            ['class' => UserLoggedInFilter::class],
        ];
    }


    public function actionIndex(string $name) {
        $user = $this->userService->getUserByName($name);

        if (is_null($user)) {
            Yii::$app->response->redirect([
                'error/index',
                'message' => 'This user does not exist.'
            ]);
            return false;
        }

        $this->view->title = 'Justice PLUS - Profile';

        return $this->render('index', [
            'user' => $user,
            'ac_problems' => $this->userService->getSolvedProblemCount($user->id),
            'all_problems' => Problem::find()->count(),
            'ac_submissions' => $user->getAcceptedSubmissionCount(),
            'all_submissions' => $user->getSubmissionCount(),
            'status' => $this->userService->getProblemSolvedStatus($user->id),
            'language' => $this->userService->getSubmissionLanguages($user->id)
        ]);
    }
}
