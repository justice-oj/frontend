<?php

namespace admin\modules\user\controllers;

use admin\controllers\BaseController;
use admin\filters\AdminLoggedinFilter;
use common\services\UserService;
use Kilte\Pagination\Pagination;
use Yii;
use yii\helpers\Html;

class ManageController extends BaseController {
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
            ['class' => AdminLoggedinFilter::className()],
        ];
    }


    public function actionIndex(string $id = null, string $username = null, string $email = null) {
        $this->view->title = 'Justice PLUS Admin - Users';

        $query = $this->userService->searchUsers($id, $username, $email);
        $pagination = new Pagination(
            $query->count(),
            intval(Yii::$app->request->get('page', 1)),
            Yii::$app->params['paginationPerPage']
        );

        return $this->render('index', [
            'id' => Html::encode($id),
            'username' => Html::encode($username),
            'email' => Html::encode($email),
            'pagination' => $pagination->build(),
            'records' => $query->offset($pagination->offset())->limit($pagination->limit())->all()
        ]);
    }
}