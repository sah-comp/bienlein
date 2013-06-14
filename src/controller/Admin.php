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
        Auth::check();
        Flight::render('admin/navigation', array(), 'navigation');
        Flight::render('admin/index', array(), 'content');
        Flight::render('html5', array(
            'title' => I18n::__('admin_head_title'),
            'language' => Flight::get('language')
        ));
    }
    
    /**
     * Displays the admin user page.
     */
    static public function user()
    {
        session_start();
        Auth::check();
        Flight::render('admin/navigation', array(), 'navigation');
        Flight::render('admin/user', array(), 'content');
        Flight::render('html5', array(
            'title' => I18n::__('admin_head_title'),
            'language' => Flight::get('language')
        ));
    }
}
