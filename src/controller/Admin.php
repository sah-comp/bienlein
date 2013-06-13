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
        session_start();
        if ( ! isset($_SESSION['tick'])) {
            $_SESSION['tick'] = 0;
        }
        $_SESSION['tick']++;
        Flight::render('html5', array(
            'title' => I18n::__('admin_head_title'),
            'language' => Flight::get('language'),
            'content' => sprintf('Area %s, Tick %d', $section, $_SESSION['tick']),
        ));
    }
}
