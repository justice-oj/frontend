<?php

namespace www\controllers;

use common\models\Submission;
use common\services\UserService;
use Kilte\Pagination\Pagination;
use www\filters\UserLoggedinFilter;
use Yii;

class RankingController extends BaseController {
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
            ['class' => UserLoggedinFilter::className()],
        ];
    }


    public function actionIndex() {
        $this->view->title = 'Justice PLUS - Ranking';

        $pagination = new Pagination(
            Submission::find()->select(['user_id'])->distinct()->count(),
            intval(Yii::$app->request->get('page', 1)),
            Yii::$app->params['paginationPerPage']
        );

        return $this->render('index', [
            'pagination' => $pagination->build(),
            'records' => $this->userService->getUserRanking($pagination->offset(), $pagination->limit()),
        ]);
    }
}
