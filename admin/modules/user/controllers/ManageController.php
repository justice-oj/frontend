<?php

namespace admin\modules\user\controllers;

use admin\controllers\BaseController;
use admin\filters\AdminLoggedInFilter;
use common\services\UserService;
use Kilte\Pagination\Pagination;
use Yii;
use yii\helpers\Html;
use yii\web\Response;

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
            ['class' => AdminLoggedInFilter::className()],
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


    public function actionNew() {
        $this->view->title = 'Justice PLUS Admin - Add User';
        return $this->render('new');
    }


    public function actionAdd() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $username = Yii::$app->request->post('username');
        $email = Yii::$app->request->post('email');
        $password = Yii::$app->request->post('password');

        if (empty($username) || empty($email) || empty($password)) {
            return [
                'code' => 1,
                'message' => 'missing argument(s)'
            ];
        }

        try {
            if ($this->userService->addUser($username, $email, $password)) {
                return [
                    'code' => 0,
                    'message' => 'OK'
                ];
            } else {
                return [
                    'code' => 2,
                    'message' => 'an error occurred'
                ];
            }
        } catch (\Exception $e) {
            return [
                'code' => 2,
                'message' => $e->getMessage()
            ];
        }
    }


    public function actionEdit(string $user_id) {
        $this->view->title = 'Justice PLUS Admin - Edit User';

        $user = $this->userService->getUserByID($user_id);
        return $this->render('edit', [
            'user' => $user,
        ]);
    }


    public function actionUpdate() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $user_id = Yii::$app->request->post('user_id');
        $username = Yii::$app->request->post('username');
        $email = Yii::$app->request->post('email');
        $password = Yii::$app->request->post('password');

        if (empty($user_id) || empty($username) || empty($email) || empty($password)) {
            return [
                'code' => 1,
                'message' => 'missing argument(s)'
            ];
        }

        $user = $this->userService->getUserByID($user_id);
        if (is_null($user)) {
            return [
                'code' => 2,
                'message' => 'user not exists'
            ];
        }

        try {
            if ($this->userService->updateUser($user, $username, $email, $password)) {
                return [
                    'code' => 0,
                    'message' => 'OK'
                ];
            } else {
                return [
                    'code' => 3,
                    'message' => 'an error occurred'
                ];
            }
        } catch (\Exception $e) {
            return [
                'code' => 4,
                'message' => $e->getMessage()
            ];
        }
    }


    public function actionDelete() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $user_id = Yii::$app->request->post('user_id');
        if (empty($user_id)) {
            return [
                'code' => 1,
                'message' => 'missing argument(s)'
            ];
        }

        $result = $this->userService->deleteUser($user_id);
        if ($result === false) {
            return [
                'code' => 2,
                'message' => 'remove record failed'
            ];
        }

        return [
            'code' => 0,
            'message' => 'OK'
        ];
    }
}