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
 * Admin controller.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Admin extends Controller
{
    /**
     * Displays the admin index page.
     *
     * @param string (optional) $section
     */
    static public function index($section = 'index')
    {
        Flight::render('html5', array('content' => 'Admin area '.$section));
    }
}
