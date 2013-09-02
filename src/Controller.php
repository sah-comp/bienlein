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
 * Controller.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @version $Id$
 */
class Controller
{
    /**
     * Constructs a new Controller.
     */
    public function __construct()
    {
    }

    /**
     * Runs a plugin from the plugin directory.
     *
     * @param string $method
     * @param array (optional) $params
     * @return mixed
     * @throws Exception_Plugin when the plugin was not loadable
     */
    public function __call($method, array $params = array())
    {
        $plugin_name = 'Plugin_'.ucfirst(strtolower($method));
        if ( ! class_exists($plugin_name, true)) {
            throw new Exception_Plugin('Missing plugin '.$plugin_name);
        }
        $plugin = new $plugin_name($this);
        return call_user_func_array(array($plugin, 'execute'), $params);
    }
    
    /**
     * Go to a internal URL.
     *
     * @uses Flight::redirect()
     * @param string $url
     * @param bool (optional) $raw defaults to false, if true the url will not be prefixed
     */
    static public function redirect($url = null, $raw = false)
    {
        if ( ! $raw && Flight::get('language') != Flight::get('default_language')) {
            $url = '/'.Flight::get('language').$url; //prefix with language code
        }
        Flight::redirect($url);
        exit;
    }
}
