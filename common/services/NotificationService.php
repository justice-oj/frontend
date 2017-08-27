<?php

namespace common\services;

use Yii;

/**
 * Class NotificationService
 * @package common\services
 */
class NotificationService {
    const NOTICE_QUEUE_PREFIX = 'notice_queue_';
    const NOTICE_COUNTER_PREFIX = 'notice_counter_';
    const NOTICE_READ_PREFIX = 'notice_read_';


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   string $username
     * @return int
     * @desc
     */
    public static function getNewNoticeCounter(string $username) {
        return intval(Yii::$app->get('redis')->get(self::NOTICE_COUNTER_PREFIX . $username));
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   string $username
     * @param   int $counter
     * @return
     * @desc
     */
    public static function setNewNoticeCounter(string $username, int $counter) {
        return Yii::$app->get('redis')->set(self::NOTICE_COUNTER_PREFIX . $username, $counter);
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param string $username
     * @return int
     * @desc
     */
    public static function increaseNewNoticeCounter(string $username) {
        return intval(Yii::$app->get('redis')->incr(self::NOTICE_COUNTER_PREFIX . $username));
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   string $username
     * @return  int
     * @desc
     */
    public static function decreaseNewNoticeCounter(string $username) {
        return intval(Yii::$app->get('redis')->decr(self::NOTICE_COUNTER_PREFIX . $username));
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   string $username
     * @return  int
     * @desc
     */
    public static function getNoticeListCounter(string $username) {
        return intval(Yii::$app->get('redis')->zcard(self::NOTICE_QUEUE_PREFIX . $username));
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   string $username
     * @param   int $start
     * @param   int $end
     * @return
     * @desc
     */
    public static function getNotices(string $username, int $start, int $end) {
        return Yii::$app->get('redis')->zrevrange(self::NOTICE_QUEUE_PREFIX . $username, $start, $end);
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param string $username
     * @param string $content
     * @desc
     */
    public static function addNotice(string $username, string $content) {
        Yii::$app->get('redis')->zadd(
            self::NOTICE_QUEUE_PREFIX . $username,
            intval(microtime(true) * 10000),
            $content
        );
        self::increaseNewNoticeCounter($username);
    }
}