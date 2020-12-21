<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage I18n
 * @author $Author$
 * @version $Id$
 */

/**
 * Internationalization.
 *
 * @package Cinnebar
 * @subpackage I18n
 * @version $Id$
 */
class I18n
{
    /**
     * Returns a translated string.
     *
     * This function looks up the global array "tokens" first. If this exists and the requested
     * token is set, the translation will be taken from that array instead of
     * querying the database.
     *
     * To generate the tokens array call index.php from the command line with this command:
     *
     * php -f cli/token-cache.php -- --language=de
     * php -f cli/token-cache.php --
     *
     * The first option will generate the german language file only while the second
     * option will generate all active language files.
     *
     * @param string $text to translate
     * @param string (optional) $language iso code of the language to use for translation
     * @param array (optional) $values to mix with the i18n->name of a token
     * @return string
     */
    public static function __($text, $language = null, array $values = array())
    {
        if ($language === null) {
            $language = Flight::get('language');
        }
        $tokens = Flight::get('tokens');
        if (isset($tokens[$text])) {
            return vsprintf($tokens[$text], $values);
        }
        if (! $token = R::findOne('token', ' name = ?', array($text))) {
            $token = R::dispense('token');
            $token->name = $text;
            R::store($token);
        }
        if (! empty($values)) {
            return vsprintf($token->i18n($language)->name, $values);
        }
        return $token->i18n($language)->name;
    }

    /**
     * Loads a language file if it exists and returns wether it was loaded or not.
     *
     * @param $iso
     * @return bool
     */
    public static function load($iso = '')
    {
        if (!$iso) {
            $iso = Flight::get('language');
        }
        /**
         * Load language file in case it exists.
         */
        if (file_exists(__DIR__ . '/../app/res/lng/' . $iso . '.php')) {
            require __DIR__ . '/../app/res/lng/' . $iso . '.php';
            Flight::set('tokens', $_tokens);
            return true;
        }
        return false;
    }

    /**
     * Generates a translated token from an array.
     *
     * @param string $text
     * @param array $translations
     * @return bool
     */
    public static function make($text, array $translations)
    {
        $token = R::dispense('token');
        $token->name = $text;
        foreach ($translations as $language => $translation) {
            $tokeni18n = R::dispense('tokeni18n');
            $tokeni18n->name = $translation;
            $tokeni18n->language = $language;
            $token->ownTokeni18n[] = $tokeni18n;
        }
        R::store($token);
        return true;
    }
}
