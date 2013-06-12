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
     * @return string
     */
    static public function __($text, $language = null)
    {
        if ($language === null) $language = Flight::get('language');
        if ( ! $token = R::findOne('token', ' name = ?', array($text))) {
            $token = R::dispense('token');
            $token->name = $text;
            R::store($token);
        }
        return $token->i18n($language)->name;
    }
}
