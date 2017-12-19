<?php

namespace common\services;

use common\models\Editorial;

/**
 * Class EditorialService
 * @package common\services
 */
class EditorialService {
    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $problem_id
     * @return \common\models\Editorial|null
     * @desc
     */
    public function getEditorialByProblemID(int $problem_id) {
        return Editorial::findOne(['problem_id' => $problem_id]);
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $problem_id
     * @param   string $content
     * @return  bool
     * @desc
     */
    public function addEditorial(int $problem_id, string $content) {
        $editorial = new Editorial();
        $editorial->problem_id = $problem_id;
        $editorial->content = $content;
        return $editorial->save();
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $problem_id
     * @param   string $content
     * @return  bool
     * @desc
     */
    public function updateEditorial(int $problem_id, string $content) {
        $editorial = Editorial::findOne(['problem_id' => $problem_id]);
        if (is_null($editorial)) return false;

        $editorial->problem_id = $problem_id;
        $editorial->content = $content;
        return $editorial->save();
    }


    /** @noinspection PhpUndefinedClassInspection */
    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $problem_id
     * @return  false|int
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @desc
     */
    public function removeEditorial(int $problem_id) {
        return Editorial::findOne(['problem_id' => $problem_id])->delete();
    }
}