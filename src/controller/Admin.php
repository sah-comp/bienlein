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
     */
    static public function index()
    {
        session_start();
        Flight::render('html5', array(
            'title' => I18n::__('admin_head_title'),
            'language' => Flight::get('language'),
            'content' => 'Admin::index',
        ));
    }
    
    /**
     * Displays the admin user page.
     */
    static public function user()
    {
        session_start();
        Flight::render('html5', array(
            'title' => I18n::__('admin_head_title'),
            'language' => Flight::get('language'),
            'content' => 'Admin::user',
        ));
    }
}
