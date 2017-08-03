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
}