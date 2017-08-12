<?php

namespace www\Presenters;

class UserPresenter {
    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   string $website
     * @return  string user's website link
     */
    public function getWebsiteLink(?string $website) {
        if (stripos($website, 'http://') === 0 || stripos($website, 'https://') === 0) {
            return $website;
        } elseif (!empty($website)) {
            return 'http://' . $website;
        } else {
            return '#';
        }
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   string $website
     * @return  string display user's website for short
     */
    public function showWebsite(?string $website) {
        if (strlen($website) > 24) {
            return substr($website, 0, 24) . '...';
        } elseif (!empty($website)) {
            return $website;
        } else {
            return "I don't have any website. <i class=\"frown icon\"></i>";
        }
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   string $email
     * @return  string user's email
     */
    public function showEmailAddress(string $email) {
        if (strlen($email) > 24) {
            return substr($email, 0, 24) . '...';
        } else {
            return $email;
        }
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   string $date
     * @return  string user's joint date
     */
    public function showJointDate(string $date) {
        return date('M d, Y', strtotime($date));
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   string $country country name
     * @return  string user's AC percentage
     */
    public function showFlag(string $country) {
        return '<i class="' . strtolower($country) . ' flag"></i>';
    }


    /**
     * @author  liuchao
     * @mail    i@liuchao.me
     * @param   string $email user's email
     * @param   int $size avatar's size
     * @return  string $image_url calculated user's avatar image url from $email
     */
    public function showAvatar(string $email, int $size = 250) {
        return 'https://www.gravatar.com/avatar/' . md5(strtolower(preg_replace('/\s/', '', $email))) . '?size=' . $size;
    }
}