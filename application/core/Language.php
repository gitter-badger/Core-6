<?php

/**
 * class language
 * provides specific language texts.
 * @todo lots of stuff left to be done!
 */
class Language {

    private static $file = '.lang.json';
    private static $userLangQuery = null;

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
        $userLang = self::getUserLanguage(Session::get('user_id'));
        // If the user's language is set to null
        if (!isset($userLang)) {
            $language_file = self::getDefaultLang() . self::$file;
            $array = json_decode($language_file, true);
            return $array[$textID];
        } else {
            // If the user's language is set.
            $language_file = self::getUserLanguage(Session::get('user_id')) . self::$file;
            $array = json_decode($language_file, true);
            return $array[$textID];
        }
    }

    /**
     * Get the user language (if they are logged in)
     * @param null $userID
     * @return mixed|null
     */
    public static function getUserLanguage($userID = null) {
        if ($userID === null) {
            return null;
        } else {
            if (self::$userLangQuery === null) {
                self::$userLangQuery = DatabaseFactory::getFactory()
                    ->getConnection()
                    ->prepare('SELECT user_lang FROM users WHERE user_id = :user_id');
            }
            self::$userLangQuery->execute(array(
                'user_id' => Session::get('user_id')
            ));
            return self::$userLangQuery->fetch();
        }
    }


}