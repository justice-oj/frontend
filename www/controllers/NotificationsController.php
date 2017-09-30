<?php

namespace www\controllers;

use common\services\NotificationService;
use Kilte\Pagination\Pagination;
use www\filters\UserLoggedinFilter;
use Yii;

class NotificationsController extends BaseController {
    protected $notificationService;


    public function __construct(
        $id,
        $module,
        NotificationService $notificationService,
        $config = []
    ) {
        $this->notificationService = $notificationService;
        parent::__construct($id, $module, $config);
    }


    public function behaviors() {
        return [
            ['class' => UserLoggedinFilter::className()],
        ];
    }


    public function actionIndex() {
        $username = Yii::$app->session->get(Yii::$app->params['userNameKey']);
        $page = intval(Yii::$app->request->get('page', 1));
        $per_page = Yii::$app->params['paginationPerPage'];

        NotificationService::setNewNoticeCounter($username, 0);
        $pagination = new Pagination(NotificationService::getNoticeListCounter($username), $page, $per_page);
        $this->view->title = 'Justice PLUS - Notifications';
        return $this->render('index', [
            'pagination' => $pagination->build(),
            'notices' => NotificationService::getNotices($username, ($page - 1) * $per_page, $page * $per_page - 1),
        ]);
    }
}
