<?php

namespace www\modules\problem\controllers;

use admin\controllers\BaseController;
use common\services\EditorialService;
use common\services\ProblemService;
use www\filters\ProblemExistsFilter;
use www\filters\UserLoggedinFilter;
use yii\helpers\Html;

class EditorialController extends BaseController {
    protected $problemService;
    protected $editorialService;


    public function __construct(
        $id,
        $module,
        ProblemService $problemService,
        EditorialService $editorialService,
        $config = []
    ) {
        $this->problemService = $problemService;
        $this->editorialService = $editorialService;
        parent::__construct($id, $module, $config);
    }


    public function behaviors() {
        return [
            ['class' => UserLoggedinFilter::className()],
            ['class' => ProblemExistsFilter::className()]
        ];
    }


    public function actionIndex(int $problem_id) {
        $problem = $this->problemService->getProblemByID($problem_id);
        $editorial = $this->editorialService->getEditorialByProblemID($problem_id);
        $this->view->title = 'Justice PLUS - Editorial of ' . Html::encode($problem->title);

        return $this->render('index', [
            'problem' => $problem,
            'editorial' => $editorial,
        ]);
    }
}