<?php

namespace common\services;

use common\models\ProblemTag;
use common\models\Tag;

/**
 * Class TestCaseService
 * @package common\services
 */
class TagService {
    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $id
     * @return  \common\models\Tag|null
     * @desc
     */
    public function getTagByID(int $id) {
        return Tag::findOne($id);
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param string $name
     * @return int
     * @desc
     */
    public function addTag(string $name) {
        $tag = new Tag();
        $tag->name = $name;
        $tag->save();

        return $tag->id;
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   \common\models\Tag $tag
     * @param string $name
     * @return bool
     * @desc
     */
    public function updateTag($tag, string $name) {
        $tag->name = $name;
        return $tag->save();
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $tag_id
     * @return  false|int
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @desc
     */
    public function deleteTag(int $tag_id) {
        return Tag::findOne($tag_id)->delete();
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @return  array|\yii\db\ActiveRecord[]
     * @desc    get all tags
     */
    public function getTags() {
        return Tag::find()->asArray()->all();
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $problem_id
     * @return  ProblemTag[]
     * @desc
     */
    public function getTagsByProblemID(int $problem_id) {
        return ProblemTag::find()
            ->select('t_tag.*')
            ->leftJoin('t_tag', '`t_problem_tag`.`tag_id` = `t_tag`.`id`')
            ->where(['`t_problem_tag`.`problem_id`' => $problem_id])
            ->asArray()->all();
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $id|null
     * @param   string $name|null
     * @return  \Yii\db\ActiveQuery
     * @desc    search tags by id and/or name
     */
    public function searchTags($id, $name) {
        return Tag::find()
            ->andFilterWhere(['id' => $id])
            ->andFilterWhere(['LIKE', 'name', $name])
            ->orderBy(['id' => SORT_DESC]);
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param
     * @desc
     * @return
     */

}