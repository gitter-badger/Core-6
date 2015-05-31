<?php

class LockModel {
    public static $sendLockToDBQuery = null;
    public static $deleteFromDBQuery = null;
    public static $getRefererQuery = null;

    /**
     * Lock User
     */
    public static function lock() {
        $user_info = array(
            'user_id' => Session::get('user_id'),
            'user_name' => Session::get('user_name'),
            'user_email' => Session::get('user_email')
        );
        self::sendLockToDB($user_info['user_id'], $user_info['user_name'], Request::server('HTTP_REFERER'));
        Session::destroy();
        Session::set('user_name', $user_info['user_name']);
        Session::set('user_email', $user_info['user_email']);
        Session::set('locked', true);
        Redirect::to('lock');
    }

    public static function unlock($user_id, $username, $password) {
        if (LoginModel::login($username, $password)) {
            Redirect::referer(self::getReferer($user_id, $username));
        } else {
            Redirect::to('lock');
        }
    }

    /**
     * Send User info to DB
     * @param $user_id
     * @param $username
     * @param $refer_page
     */
    public static function sendLockToDB($user_id, $username, $refer_page) {
        if (self::$sendLockToDBQuery === null) {
            self::$sendLockToDBQuery = DatabaseFactory::getFactory()
                ->getConnection()
                ->prepare('INSERT INTO `user_lock` (`user_id`, `user_name`, `refer_page`, `session_locked`) VALUES (:user_id, :user_name, :refer_page, TRUE)');
        }
        self::$sendLockToDBQuery->execute(
            array(
                'user_id' => $user_id,
                'user_name' => $username,
                'refer_page' => $refer_page
            )
        );
    }

    /**
     * Delete user from DB after unlocking
     * @param $user_id
     * @param $username
     */
    public static function deleteFromDB($user_id, $username) {
        if (self::$deleteFromDBQuery === null) {
            self::$deleteFromDBQuery = DatabaseFactory::getFactory()
                ->getConnection()
                ->prepare('DELETE FROM `user_lock` WHERE `user_id` = :user_id AND `user_name` = :user_name');
        }
        self::$deleteFromDBQuery->execute(array('user_id' => $user_id, 'user_name' => $username));
    }

    /**
     * Get referer URL
     */
    public static function getReferer($user_id, $username) {
        if (self::$getRefererQuery === null) {
            self::$getRefererQuery = DatabaseFactory::getFactory()
                ->getConnection()
                ->prepare('SELECT `refer_page` FROM `user_lock` WHERE `user_id` = :user_id AND `user_name` = :user_name');
        }
        self::$getRefererQuery->execute(array('user_id' => $user_id, 'user_name' => $username));
        return self::$getRefererQuery->fetch();
    }

    /**
     * lockStatus() checks lock status
     */
    public static function lockStatus() {
        return Session::get('locked');
    }
}