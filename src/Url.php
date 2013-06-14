<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @author $Author$
 * @version $Id$
 */

/**
 * Url Maker.
 *
 * @package Cinnebar
 * @subpackage Url
 * @version $Id$
 */
class Url
{
    /**
     * Build internal Url.
     *
     * This will check if default language differs from current language and
     * if so, will prefix the given url with the optional language code prefix.
     *
     * If optionally a params array is given the params will be injected into
     * the given url.
     *
     * @param string $internalAbsUrl
     * @param array (optional) $parameters to be replaced within the given url
     * @return string
     */
    static public function build($internalAbsUrl, array $params = array())
    {
       if (Flight::get('language') != Flight::get('default_language')) {
           $internalAbsUrl = '/'.Flight::get('language').$internalAbsUrl;
       }
       if ( ! empty($params)) {
           $encoded = array();
           foreach ($params as $value) {
               $encoded[] = urlencode($value);
           }
           $internalAbsUrl = vsprintf($internalAbsUrl, $encoded);
       }
       return $internalAbsUrl;
    }
}
