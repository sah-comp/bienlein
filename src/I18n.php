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
     * @param string $text to translate
     * @param string (optional) $language iso code of the language to use for translation
     * @param array (optional) $values to mix with the i18n->name of a token
     * @return string
     */
    static public function __($text, $language = null, array $values = array())
    {
        if ($language === null) $language = Flight::get('language');
        if ( ! $token = R::findOne('token', ' name = ?', array($text))) {
            $token = R::dispense('token');
            $token->name = $text;
            R::store($token);
        }
        if ( ! empty($values)) return vsprintf($token->i18n($language)->name, $values);
        return $token->i18n($language)->name;
    }
    
    /**
     * Generates a translated token from an array.
     *
     * @param string $text
     * @param array $translations
     * @return bool
     */
    static public function make($text, array $translations)
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
