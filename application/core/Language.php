<?php

/**
 * class language
 * provides specific language texts.
 * @todo lots of stuff left to be done!
 */
class Language {

    private static $file = '.lang.json';

    public static function getDefaultLang() {
        return config::get('DEFAULT_LANG');
    }

    public static function getText($textID) {
        $userLang = self::getUserLanguage();
        if (!isset($userLang)) {
            $language_file = self::getUserLanguage() . $file;

        }
    }

    public static function getUserLanguage() {
        $user_id = Session::get('user_id');
        // get user language from the users table.
        return false;
    }


}