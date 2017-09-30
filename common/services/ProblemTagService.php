<?php

namespace common\services;

use common\models\ProblemTag;
use common\models\Tag;


/**
 * Class ProblemTagService
 * @package common\services
 */
class ProblemTagService {
    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $id
     * @return  \common\models\ProblemTag|null
     * @desc
     */
    public function getProblemTagByID(int $id) {
        return ProblemTag::findOne($id);
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $tag_id
     * @param   int $problem_id
     * @return  int
     * @desc
     */
    public function addProblemTag(int $tag_id, int $problem_id) {
        $problem_tag = new ProblemTag();
        $problem_tag->tag_id = $tag_id;
        $problem_tag->problem_id = $problem_id;
        return $problem_tag->save();
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $id
     * @return  false|int
     * @desc
     */
    public function deleteProblemTag(int $id) {
        return Tag::findOne($id)->delete();
    }
}