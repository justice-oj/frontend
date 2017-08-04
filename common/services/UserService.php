<?php

namespace common\services;

use common\models\Submission;
use common\models\User;
use Yii;
use yii\db\Query;

/**
 * Class UserService
 * @package common\services
 */
class UserService {
    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   int $id
     * @return \common\models\User|null
     * @desc
     */
    public function getUserByID(int $id) {
        return User::findOne($id);
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   string $email
     * @desc
     * @return  \common\models\User|null
     */
    public function getUserByEmail(string $email) {
        return User::find()->where(['email' => $email])->one();
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   string $username
     * @return  \common\models\User|null
     * @desc
     */
    public function getUserByName(string $username) {
        return User::find()->where(['username' => $username])->one();
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @desc    the big ranking
     * @param   int $offset
     * @param   int $limit
     * @return  array
     */
    public function getUserRanking($offset, $limit) {
        // SELECT `problem_id`, `user_id` FROM t_submission WHERE status = 0 GROUP BY problem_id, user_id;
        $sub_query = (new Query())
            ->from(['t_submission'])
            ->select(['problem_id', 'user_id'])
            ->where(['status' => Submission::STATUS_AC])
            ->groupBy(['user_id', 'problem_id']);

        // SELECT `user_id`, count(*) AS count FROM
        //   (SELECT `problem_id`, `user_id` FROM t_submission WHERE status = 0 GROUP BY problem_id, user_id) r
        // GROUP BY `user_id` ORDER BY count DESC;
        return array_map(function($record) {
            $user = User::findOne($record['user_id']);
            $submissions = $user->getSubmissionCount();
            return [
                'country' => $user->country,
                'username' => $user->username,
                'solved' => $record['count'],
                'tried' => Yii::$app->redis->bitcount(Yii::$app->params['userTriedCountKey'] . $record['user_id']),
                'submissions' => $submissions,
                'AC' => $submissions == 0 ? 0 : number_format($user->getAcceptedCount() * 100 / $submissions, 2),
                'since' => $user->created_at
            ];
        }, (new Query())
            ->from(['r' => $sub_query])
            ->select(['user_id', 'count(*) AS count'])
            ->groupBy(['user_id'])
            ->orderBy(['count' => SORT_DESC])
            ->offset($offset)->limit($limit)->all()
        );
    }
}