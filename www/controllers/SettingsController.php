<?php

namespace www\controllers;

use common\services\UserService;
use www\filters\UserLoggedInFilter;
use Yii;
use yii\web\Response;

class SettingsController extends BaseController {
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
            ['class' => UserLoggedInFilter::className()],
        ];
    }


    public function actionIndex() {
        $this->view->title = 'Justice PLUS - Update Profile';

        $uid = Yii::$app->session->get(Yii::$app->params['userIdKey']);
        $user = $this->userService->getUserByID($uid);

        return $this->render('index', [
            'user' => $user,
        ]);
    }


    public function actionUpdateProfile() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $uid = Yii::$app->session->get(Yii::$app->params['userIdKey']);
        $user = $this->userService->getUserByID($uid);

        try {
            $user->nickname = Yii::$app->request->post('nickname');
            $user->website = Yii::$app->request->post('website');
            $user->country = strtolower(Yii::$app->request->post('country'));
            $user->bio = Yii::$app->request->post('bio');
            $user->save();

            return [
                'code' => 0,
                'message' => 'OK'
            ];
        } catch (\Exception $e) {
            return [
                'code' => 255,
                'message' => 'Error'
            ];
        }
    }


    public function actionPassword() {
        $this->view->title = 'Justice PLUS - Update Password';
        return $this->render('password');
    }


    public function actionUpdatePassword() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $uid = Yii::$app->session->get(Yii::$app->params['userIdKey']);
        $user = $this->userService->getUserByID($uid);

        $origin = $user->password;
        $old = Yii::$app->request->post('old_password');
        $new = Yii::$app->request->post('new_password');

        try {
            if (password_verify($old, $origin)) {
                $user->password = password_hash($new, PASSWORD_BCRYPT, ['cost' => 12]);
                $user->save();

                return [
                    'code' => 0,
                    'message' => 'OK'
                ];
            } else {
                return [
                    'code' => 1,
                    'message' => 'Old password not match, please re-check again.'
                ];
            }
        } catch (\Exception $e) {
            return [
                'code' => 255,
                'message' => 'Error'
            ];
        }
    }
}
