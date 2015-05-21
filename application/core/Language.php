<?php

/**
 * class language
 * provides specific language texts.
 * @todo lots of stuff left to be done!
 */
class Language {

    private static $file = '.lang.json';

    /**
     * Get the site language
     * @return mixed
     */
    public static function getDefaultLang() {
        return Config::get('DEFAULT_LANG');
    }

    /**
     * Get Text based on language
     * @param $textID
     * @return mixed
     */
    public static function getText($textID) {
        $userLang = self::getUserLanguage();
        // If the user's language is set to null
        if (!isset($userLang)) {
            $language_file = self::getDefaultLang() . self::$file;
            $array = json_decode($language_file, true);
            return $array[$textID];
        } else {
            // If the user's language is set.
            $language_file = self::getUserLanguage() . self::$file;
            $array = json_decode($language_file, true);
            return $array[$textID];
        }
    }

    /**
     * Get the users language (if set)
     * @return bool
     */
    public static function getUserLanguage() {
        $user_id = Session::get('user_id');
        // get user language from the users table.
        return false;
    }


}