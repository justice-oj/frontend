<?php

namespace common\services;

use common\models\User;
use common\models\UserProblem;

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
     * @desc    the big ranking
     * @param   int $offset
     * @param   int $limit
     * @return  array
     */
    public function getUserRanking($offset, $limit) {
        return array_map(function($record) {
            $user = User::findOne($record['user_id']);
            $submissions = $user->getSubmissionCount();
            return [
                'country' => $user->country,
                'username' => $user->username,
                'solved' => $record['count'],
                'tried' => $user->getTriedCount(),
                'submissions' => $submissions,
                'AC' => $submissions == 0 ? 0 : number_format($user->getAcceptedCount() * 100 / $submissions, 2),
                'since' => $user->created_at
            ];
        }, UserProblem::find()
            ->select([
                'user_id',
                'count(*) AS count'
            ])
            ->where(['status' => UserProblem::STATUS_SOLVED])
            ->groupBy(['user_id'])
            ->orderBy(['count' => SORT_DESC])
            ->offset($offset)->limit($limit)->asArray()->all()
        );
    }
}