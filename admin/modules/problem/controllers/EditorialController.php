<?php

namespace admin\modules\problem\controllers;

use admin\controllers\BaseController;
use admin\filters\AdminLoggedinFilter;
use common\services\EditorialService;
use common\services\ProblemService;
use common\services\UserService;
use Yii;
use yii\web\Response;

class EditorialController extends BaseController {
    protected $problemService;
    protected $editorialService;
    protected $userService;


    public function __construct(
        $id,
        $module,
        ProblemService $problemService,
        EditorialService $editorialService,
        UserService $userService,
        $config = []
    ) {
        $this->problemService = $problemService;
        $this->editorialService = $editorialService;
        $this->userService = $userService;
        parent::__construct($id, $module, $config);
    }


    public function behaviors() {
        return [
            ['class' => AdminLoggedinFilter::className()],
        ];
    }


    public function actionIndex(int $problem_id) {
        $this->view->title = 'Justice PLUS Admin - Editorial';

        $problem = $this->problemService->getProblemByID($problem_id);
        $editorial = $this->editorialService->getEditorialByProblemID($problem_id);

        if (is_null($editorial)) {
            return $this->render('new', [
                'problem' => $problem
            ]);
        } else {
            return $this->render('edit', [
                'problem' => $problem,
                'editorial' => $editorial
            ]);
        }
    }


    public function actionAdd() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $problem_id = intval(Yii::$app->request->post('problem_id'));
        $editorial = Yii::$app->request->post('editorial');

        if (empty($problem_id) || empty($editorial)) {
            return [
                'code' => 1,
                'message' => 'missing argument(s)'
            ];
        }

        if ($this->editorialService->addEditorial($problem_id, $editorial)) {
            return [
                'code' => 0,
                'message' => 'OK'
            ];
        } else {
            return [
                'code' => 2,
                'message' => 'failed'
            ];
        }
    }


    public function actionUpdate() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $problem_id = intval(Yii::$app->request->post('problem_id'));
        $editorial = Yii::$app->request->post('editorial');

        if (empty($problem_id) || empty($editorial)) {
            return [
                'code' => 1,
                'message' => 'missing argument(s)'
            ];
        }

        if ($this->editorialService->updateEditorial($problem_id, $editorial)) {
            return [
                'code' => 0,
                'message' => 'OK'
            ];
        } else {
            return [
                'code' => 2,
                'message' => 'failed'
            ];
        }
    }


    public function actionDelete() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $problem_id = intval(Yii::$app->request->post('problem_id'));
        if (empty($problem_id)) {
            return [
                'code' => 1,
                'message' => 'missing argument(s)'
            ];
        }

        if ($this->editorialService->removeEditorial($problem_id) === false) {
            return [
                'code' => 2,
                'message' => 'remove record failed'
            ];
        } else {
            return [
                'code' => 0,
                'message' => 'OK'
            ];
        }
    }
}