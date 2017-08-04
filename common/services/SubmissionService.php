<?php

namespace common\services;

use common\models\Submission;

/**
 * Class SubmissionService
 * @package common\services
 */
class SubmissionService {
    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param int $id
     * @return \common\models\Submission|null
     * @desc
     */
    public function getSubmissionByID(int $id) {
        return Submission::findOne($id);
    }
}