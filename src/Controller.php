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
}
