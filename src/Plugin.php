<?php
/**
 * Cinnebar.
 *
 * My lightweight no-framework framework written in PHP.
 *
 * @package Cinnebar
 * @author $Author$
 * @version $Id$
 */

/**
 * The basic plugin class of the cinnebar system.
 *
 * To add your own plugin simply add a php file to the plugin directory of your Cinnebar
 * installation. Name the plugin after the scheme Plugin_* extends Cinnebar and
 * implement a execute() method. You will not call a plugin directly, but you will use it from
 * a controller.
 *
 * @package Cinnebar
 * @subpackage Plugin
 * @version $Id$
 */
class Plugin
{
    /**
     * Holds the instance of the controller in which this plugin runs.
     *
     * @var Cinnebar_Controller
     */
    public $controller;

    /**
     * Constructor.
     * @param Cinnebar_View $view
     */
    public function __construct(Controller $controller)
    {
        $this->controller = $controller;
    }
    
    /**
     * Returns an instance of the controller from which this plugin was called.
     *
     * @return Cinnebar_Controller
     */
    public function controller()
    {
        return $this->controller;
    }
    
    /**
     * Executes the plugin.
     *
     * @return bool $alwaysTrue
     */
    public function execute()
    {
        echo 'Hello, i am a plugin.';
    }
}
