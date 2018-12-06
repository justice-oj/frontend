<?php

namespace admin\controllers;

use admin\filters\AdminLoginFilter;
use common\services\AdminService;
use Yii;
use yii\web\Response;

class LoginController extends BaseController
{
    protected $adminService;


    public function __construct(
        $id,
        $module,
        AdminService $adminService,
        $config = []
    )
    {
        $this->adminService = $adminService;
        parent::__construct($id, $module, $config);
    }


    public function behaviors()
    {
        return [
            ['class' => AdminLoginFilter::class, 'only' => ['auth']],
        ];
    }


    public function actionIndex()
    {
        $this->layout = 'login';
        return $this->render('index');
    }


    public function actionAuth()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');

        $admin = $this->adminService->getAdminByUsername($username);
        if (!is_null($admin) && password_verify($password, $admin->password)) {
            Yii::$app->session->set(Yii::$app->params['adminLoggedInKey'], 1);
            return [
                'message' => 'OK',
                'code' => 0
            ];
        } else {
            return [
                'message' => 'Login failed',
                'code' => 1
            ];
        }
    }
}