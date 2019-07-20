<?php

namespace www\controllers;

use common\services\ProblemService;
use Kilte\Pagination\Pagination;
use www\filters\UserLoggedInFilter;
use Yii;
use yii\helpers\Html;

class ProblemsController extends BaseController {
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
            ['class' => UserLoggedInFilter::class],
        ];
    }


    public function actionIndex(string $id = null, string $title = null) {
        $this->view->title = 'Justice PLUS - Problems';

        $query = $this->problemService->searchProblems($id, $title);
        $pagination = new Pagination(
            $query->count(),
            intval(Yii::$app->request->get('page', 1)),
            Yii::$app->params['paginationPerPage']
        );

        return $this->render('index', [
            'id' => Html::encode($id),
            'title' => Html::encode($title),
            'pagination' => $pagination->build(),
            'records' => $this->problemService->getProblemsWithStatus($query, $pagination->offset(), $pagination->limit()),
        ]);
    }
}
