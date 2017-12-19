<?php

namespace admin\modules\tag\controllers;

use admin\controllers\BaseController;
use admin\filters\AdminLoggedInFilter;
use common\services\TagService;
use Kilte\Pagination\Pagination;
use Yii;
use yii\helpers\Html;
use yii\web\Response;

class ManageController extends BaseController {
    protected $tagService;


    public function __construct(
        $id,
        $module,
        TagService $tagService,
        $config = []
    ) {
        $this->tagService = $tagService;
        parent::__construct($id, $module, $config);
    }


    public function behaviors() {
        return [
            ['class' => AdminLoggedInFilter::className()],
        ];
    }


    public function actionIndex(string $id = null, string $name = null) {
        $this->view->title = 'Justice PLUS Admin - Tags';

        $query = $this->tagService->searchTags($id, $name);
        $pagination = new Pagination(
            $query->count(),
            intval(Yii::$app->request->get('page', 1)),
            Yii::$app->params['paginationPerPage']
        );

        return $this->render('index', [
            'id' => Html::encode($id),
            'name' => Html::encode($name),
            'pagination' => $pagination->build(),
            'records' => $query->offset($pagination->offset())->limit($pagination->limit())->all()
        ]);
    }


    public function actionNew() {
        $this->view->title = 'Justice PLUS Admin - Add Tag';
        return $this->render('new');
    }


    public function actionAdd() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $name = Yii::$app->request->post('name');

        if (empty($name) ) {
            return [
                'code' => 1,
                'message' => 'missing `name`'
            ];
        }

        try {
            if ($this->tagService->addTag($name)) {
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


    public function actionEdit(int $tag_id) {
        $this->view->title = 'Justice PLUS Admin - Edit Tag';

        $tag = $this->tagService->getTagByID($tag_id);
        return $this->render('edit', [
            'tag' => $tag,
        ]);
    }


    public function actionUpdate() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $tag_id = Yii::$app->request->post('tag_id');
        $name = Yii::$app->request->post('name');

        if (empty($tag_id)) {
            return [
                'code' => 1,
                'message' => 'missing `tag_id`'
            ];
        }

        $tag = $this->tagService->getTagByID($tag_id);
        if (is_null($tag)) {
            return [
                'code' => 2,
                'message' => 'user not exists'
            ];
        }

        try {
            if ($this->tagService->updateTag($tag, $name)) {
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


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @return array
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @desc
     */
    public function actionDelete() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $tag_id = Yii::$app->request->post('tag_id');
        if (empty($tag_id)) {
            return [
                'code' => 1,
                'message' => 'missing `tag_id`'
            ];
        }

        $result = $this->tagService->deleteTag($tag_id);
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